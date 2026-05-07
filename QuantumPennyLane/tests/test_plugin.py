import pytest

from pytest_quantum import pytest_collection_modifyitems, pytest_report_header


class DummyItem:
    def __init__(self):
        self._markers = []

    def add_marker(self, marker):
        self._markers.append(marker)

    def get_closest_marker(self, name):
        for marker in self._markers:
            if getattr(marker, "name", None) == name:
                return marker
        return None


class DummyConfig:
    def __init__(self):
        self._options = {"--quantum-slow": False, "--quantum-real": False}
        self._quantum_info = {"qiskit": False, "cirq": False}

    def getoption(self, name):
        return self._options.get(name)


def test_collection_skips_slow_by_default():
    config = DummyConfig()
    item = DummyItem()
    item.add_marker(type("Marker", (), {"name": "quantum_slow"}))
    pytest_collection_modifyitems(config, [item])
    assert item.get_closest_marker("skip") is not None


def test_report_header_when_no_frameworks_installed():
    config = DummyConfig()
    assert (
        pytest_report_header(config)
        == "pytest-quantum: no optional quantum frameworks detected"
    )
