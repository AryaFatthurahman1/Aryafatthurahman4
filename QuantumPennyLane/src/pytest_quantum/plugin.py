"""
pytest-quantum plugin entry point.

Registers CLI options, markers, and provides test session information.
"""

import pytest

from .fixtures import quantum_hardware_info
from .syrec_integration import syrec_cli_options


def pytest_addoption(parser):
    """Add pytest-quantum CLI options."""
    group = parser.getgroup("quantum", "Quantum Testing Options")
    
    # Core quantum options
    group.addoption(
        "--quantum-slow",
        action="store_true",
        default=False,
        help="Run tests marked with pytest.mark.quantum_slow",
    )
    group.addoption(
        "--quantum-real",
        action="store_true",
        default=False,
        help="Run tests on real quantum hardware (requires credentials)",
    )
    group.addoption(
        "--quantum-shots",
        action="store",
        type=int,
        default=None,
        help="Override default shot count for all quantum tests",
    )
    group.addoption(
        "--quantum-significance",
        action="store",
        type=float,
        default=0.01,
        help="Override p-value threshold for statistical assertions",
    )
    group.addoption(
        "--quantum-update-snapshots",
        action="store_true",
        default=False,
        help="Regenerate quantum snapshot files",
    )
    
    # Framework-specific options
    group.addoption(
        "--quantum-backends",
        action="store",
        default="",
        help="Comma-separated list of backends to test against",
    )
    group.addoption(
        "--quantum-benchmark",
        action="store_true",
        default=False,
        help="Run quantum benchmarking tests",
    )
    group.addoption(
        "--quantum-mitigation",
        action="store_true",
        default=False,
        help="Run error mitigation tests",
    )
    group.addoption(
        "--quantum-qec",
        action="store_true",
        default=False,
        help="Run quantum error correction tests",
    )
    
    # Shot budget options
    group.addoption(
        "--quantum-max-shots",
        action="store",
        type=int,
        default=None,
        help="Maximum total shots allowed for test session",
    )
    group.addoption(
        "--quantum-verbose",
        action="store_true",
        default=False,
        help="Enable verbose quantum test output",
    )
    
    # SyReC options
    syrec_cli_options(parser)


def pytest_configure(config):
    """Configure pytest with quantum markers."""
    # Core markers
    config.addinivalue_line(
        "markers",
        "quantum: mark test as a quantum test",
    )
    config.addinivalue_line(
        "markers",
        "quantum_slow: mark test as a slow quantum test (skipped unless --quantum-slow)",
    )
    config.addinivalue_line(
        "markers",
        "quantum_real: mark test requiring real quantum hardware (skipped unless --quantum-real)",
    )
    config.addinivalue_line(
        "markers",
        "quantum_benchmark: mark test as a quantum benchmark",
    )
    config.addinivalue_line(
        "markers",
        "quantum_mitigation: mark test as error mitigation test",
    )
    config.addinivalue_line(
        "markers",
        "quantum_qec: mark test as quantum error correction test",
    )
    
    # Shot and significance markers
    config.addinivalue_line(
        "markers",
        "shots(n): specify minimum shots for this test",
    )
    config.addinivalue_line(
        "markers",
        "significance(p): specify significance level for this test",
    )
    
    # Framework-specific markers
    config.addinivalue_line(
        "markers",
        "qiskit: mark test as Qiskit-specific",
    )
    config.addinivalue_line(
        "markers",
        "cirq: mark test as Cirq-specific",
    )
    config.addinivalue_line(
        "markers",
        "pennylane: mark test as PennyLane-specific",
    )
    config.addinivalue_line(
        "markers",
        "braket: mark test as Amazon Braket-specific",
    )
    config.addinivalue_line(
        "markers",
        "mitiq: mark test as Mitiq-specific",
    )
    config.addinivalue_line(
        "markers",
        "stim: mark test as Stim-specific (QEC)",
    )
    
    # Backend markers
    config.addinivalue_line(
        "markers",
        "ibm: mark test for IBM Quantum hardware",
    )
    config.addinivalue_line(
        "markers",
        "ionq: mark test for IonQ hardware",
    )
    config.addinivalue_line(
        "markers",
        "quantinuum: mark test for Quantinuum hardware",
    )
    
    # SyReC markers
    config.addinivalue_line(
        "markers",
        "syrec: mark test as SyReC reversible circuit test",
    )
    
    # Store quantum hardware info in config
    config._quantum_info = quantum_hardware_info()
    config._quantum_shots_used = 0


def pytest_collection_modifyitems(config, items):
    """Modify test collection based on CLI options."""
    # Create skip markers
    skip_slow = pytest.mark.skip(reason="Use --quantum-slow to run slow quantum tests")
    skip_real = pytest.mark.skip(reason="Use --quantum-real to run hardware tests")
    skip_benchmark = pytest.mark.skip(reason="Use --quantum-benchmark to run benchmarks")
    skip_mitigation = pytest.mark.skip(reason="Use --quantum-mitigation to run mitigation tests")
    skip_qec = pytest.mark.skip(reason="Use --quantum-qec to run QEC tests")
    
    # Get CLI options
    run_slow = config.getoption("--quantum-slow")
    run_real = config.getoption("--quantum-real")
    run_benchmark = config.getoption("--quantum-benchmark")
    run_mitigation = config.getoption("--quantum-mitigation")
    run_qec = config.getoption("--quantum-qec")
    
    # Get backend filter
    backend_filter = config.getoption("--quantum-backends")
    if backend_filter:
        allowed_backends = set(backend_filter.split(","))
    else:
        allowed_backends = None
    
    for item in items:
        # Handle quantum_slow marker
        if item.get_closest_marker("quantum_slow") and not run_slow:
            item.add_marker(skip_slow)
        
        # Handle quantum_real marker
        if item.get_closest_marker("quantum_real") and not run_real:
            item.add_marker(skip_real)
        
        # Handle quantum_benchmark marker
        if item.get_closest_marker("quantum_benchmark") and not run_benchmark:
            item.add_marker(skip_benchmark)
        
        # Handle quantum_mitigation marker
        if item.get_closest_marker("quantum_mitigation") and not run_mitigation:
            item.add_marker(skip_mitigation)
        
        # Handle quantum_qec marker
        if item.get_closest_marker("quantum_qec") and not run_qec:
            item.add_marker(skip_qec)
        
        # Handle backend filtering
        if allowed_backends:
            # Check if test has any backend-specific markers
            backend_markers = ["qiskit", "cirq", "pennylane", "braket", "ibm", "ionq", "quantinuum"]
            test_backends = set()
            for marker in backend_markers:
                if item.get_closest_marker(marker):
                    test_backends.add(marker)
            
            if test_backends and not test_backends.intersection(allowed_backends):
                item.add_marker(pytest.mark.skip(
                    reason=f"Not in allowed backends: {allowed_backends}"
                ))


def pytest_report_header(config):
    """Report quantum framework availability."""
    lines = []
    
    # Detected frameworks
    packages = config._quantum_info
    installed = [name for name, available in packages.items() if available]
    
    if installed:
        lines.append(f"pytest-quantum v1.0.0 - frameworks: {', '.join(installed)}")
    else:
        lines.append("pytest-quantum v1.0.0 - no optional frameworks detected")
    
    # Shot configuration
    shots = config.getoption("--quantum-shots")
    if shots:
        lines.append(f"  Shot override: {shots}")
    
    max_shots = config.getoption("--quantum-max-shots")
    if max_shots:
        lines.append(f"  Max shots: {max_shots}")
    
    # Real hardware
    if config.getoption("--quantum-real"):
        lines.append("  Real hardware: ENABLED")
    
    # Slow tests
    if config.getoption("--quantum-slow"):
        lines.append("  Slow tests: ENABLED")
    
    return "\n".join(lines) if lines else None


def pytest_terminal_summary(terminalreporter, exitstatus, config):
    """Summary of quantum test execution."""
    # This hook can be used to report quantum-specific statistics
    pass


# Provide fixture that gives access to quantum config
def pytest_generate_tests(metafunc):
    """Parametrize tests based on quantum markers."""
    # Handle @pytest.mark.quantum_backends marker
    backends_marker = metafunc.definition.get_closest_marker("quantum_backends")
    if backends_marker:
        backends = backends_marker.args[0] if backends_marker.args else ["qiskit", "cirq"]
        if isinstance(backends, str):
            backends = backends.split(",")
        
        if "backend" in metafunc.fixturenames:
            metafunc.parametrize("backend", backends)


# Add quantum test result metadata
def pytest_runtest_setup(item):
    """Setup for quantum tests."""
    # Check if test has shots requirement
    shots_marker = item.get_closest_marker("shots")
    if shots_marker:
        n = shots_marker.args[0]
        # Could enforce minimum shots here


def pytest_runtest_makereport(item, call):
    """Create test report with quantum-specific information."""
    if call.when == "call":
        # Could add quantum-specific metadata to the report
        pass
