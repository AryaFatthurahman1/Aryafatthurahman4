"""
Qiskit Examples for pytest-quantum

Demonstrates testing quantum circuits with Qiskit and pytest-quantum.
"""

import numpy as np
import pytest

from pytest_quantum import (
    assert_circuits_equivalent,
    assert_counts_close,
    assert_measurement_distribution,
    assert_state_fidelity_above,
    assert_unitary,
    assert_circuit_depth,
    assert_gate_count,
    assert_circuit_is_clifford,
)


# Test Bell state
def test_bell_distribution(aer_simulator):
    """Test Bell state produces correct measurement distribution."""
    from qiskit import QuantumCircuit, transpile
    
    qc = QuantumCircuit(2)
    qc.h(0)
    qc.cx(0, 1)
    qc.measure_all()
    
    transpiled = transpile(qc, aer_simulator)
    job = aer_simulator.run(transpiled, shots=2000)
    counts = job.result().get_counts()
    
    # Chi-square test: won't flake on statistical noise
    assert_measurement_distribution(counts, expected_probs={"00": 0.5, "11": 0.5})


def test_hadamard_unitary():
    """Test Hadamard gate implements correct unitary."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(1)
    qc.h(0)
    
    H = np.array([[1, 1], [1, -1]]) / np.sqrt(2)
    
    # Global-phase-safe - e^(i*theta)H passes too
    assert_unitary(qc, H)


def test_bell_state_fidelity(aer_statevector_simulator):
    """Test Bell state preparation fidelity."""
    from qiskit import QuantumCircuit
    from qiskit.quantum_info import Statevector
    
    qc = QuantumCircuit(2)
    qc.h(0)
    qc.cx(0, 1)
    
    state = Statevector.from_instruction(qc)
    
    # Expected Bell state: (|00> + |11>) / sqrt(2)
    expected = np.array([1, 0, 0, 1]) / np.sqrt(2)
    
    assert_state_fidelity_above(state.data, expected, threshold=0.999)


def test_circuit_structure():
    """Test circuit structure assertions."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(3)
    qc.h(0)
    qc.cx(0, 1)
    qc.cx(1, 2)
    
    assert_circuit_depth(qc, max_depth=3)
    assert_circuit_width(qc, expected_qubits=3)
    assert_gate_count(qc, "cx", expected=2)
    assert_gate_count(qc, "h", expected=1)


def test_clifford_circuit():
    """Test Clifford circuit detection."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(2)
    qc.h(0)
    qc.cx(0, 1)
    qc.s(0)
    qc.x(1)
    
    assert_circuit_is_clifford(qc)


def test_non_clifford_circuit_fails():
    """Test that non-Clifford gates are detected."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(1)
    qc.rx(0.5, 0)  # RX with arbitrary angle is non-Clifford
    
    with pytest.raises(AssertionError):
        assert_circuit_is_clifford(qc)


def test_counts_close():
    """Test count comparison between two runs."""
    counts_a = {"00": 500, "11": 500}
    counts_b = {"00": 480, "11": 520}
    
    assert_counts_close(counts_a, counts_b, max_tvd=0.05)


def test_circuits_equivalent():
    """Test that different circuits are equivalent."""
    from qiskit import QuantumCircuit
    
    # Two different ways to make X
    qc1 = QuantumCircuit(1)
    qc1.x(0)
    
    qc2 = QuantumCircuit(1)
    qc2.h(0)
    qc2.h(0)  # H^2 = I, so this is X (up to phase)
    qc2.x(0)
    
    assert_circuits_equivalent(qc1, qc2)


@pytest.mark.qiskit
@pytest.mark.quantum_slow
def test_deep_circuit_depth(aer_simulator):
    """Test deep circuit (slow test)."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(5)
    for _ in range(100):
        for q in range(5):
            qc.h(q)
    
    # Very permissive depth check
    assert_circuit_depth(qc, max_depth=200)


@pytest.mark.shots(n=4000)
def test_with_shot_marker(aer_simulator):
    """Test with custom shot count marker."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(1)
    qc.h(0)
    qc.measure_all()
    
    job = aer_simulator.run(qc, shots=4000)
    counts = job.result().get_counts()
    
    assert "0" in counts
    assert "1" in counts


def test_random_state_generator():
    """Test random state generation."""
    from pytest_quantum.random import random_statevector
    
    state = random_statevector(3, seed=42)  # 3 qubits
    
    # Check normalization
    norm = np.linalg.norm(state)
    assert np.allclose(norm, 1.0)
    
    # Check dimension
    assert len(state) == 2**3


def test_random_unitary():
    """Test random unitary generation."""
    from pytest_quantum.random import random_unitary
    
    U = random_unitary(2, seed=42)  # 2 qubits
    
    # Check unitarity: U^dagger U = I
    product = U.conj().T @ U
    identity = np.eye(4, dtype=complex)
    
    assert np.allclose(product, identity)


@pytest.mark.significance(p=0.05)
def test_with_significance_marker(aer_simulator):
    """Test with custom significance level."""
    from qiskit import QuantumCircuit
    
    qc = QuantumCircuit(1)
    qc.h(0)
    qc.measure_all()
    
    job = aer_simulator.run(qc, shots=1000)
    counts = job.result().get_counts()
    
    assert_measurement_distribution(counts, {"0": 0.5, "1": 0.5}, significance=0.05)
