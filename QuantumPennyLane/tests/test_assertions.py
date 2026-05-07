import numpy as np

from pytest_quantum import (
    assert_counts_close,
    assert_measurement_distribution,
    assert_state_fidelity_above,
    assert_unitary,
)


def test_assert_state_fidelity_above():
    actual = np.array([1.0, 0.0], dtype=complex)
    target = np.array([1.0, 0.0], dtype=complex)
    assert_state_fidelity_above(actual, target, threshold=0.99)


def test_assert_measurement_distribution_good():
    counts = {"00": 50, "11": 50}
    expected = {"00": 0.5, "11": 0.5}
    assert_measurement_distribution(counts, expected, significance=0.001)


def test_assert_counts_close():
    a = {"0": 900, "1": 100}
    b = {"0": 880, "1": 120}
    assert_counts_close(a, b, max_tvd=0.05)


def test_assert_unitary_matrix_equivalent():
    h = np.array([[1, 1], [1, -1]], dtype=complex) / np.sqrt(2)
    assert_unitary(h, h)
