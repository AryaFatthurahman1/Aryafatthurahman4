"""
PennyLane Examples for pytest-quantum

Demonstrates testing quantum circuits with PennyLane and pytest-quantum.
"""

import numpy as np
import pytest

from pytest_quantum import (
    assert_state_fidelity_above,
    assert_expectation_value_close,
    assert_normalized,
)


@pytest.mark.pennylane
def test_pennylane_rx_gate(pennylane_device):
    """Test PennyLane RX gate produces expected state."""
    pennylane = pytest.importorskip("pennylane")
    
    dev = pennylane_device(wires=1)
    
    @pennylane.qnode(dev)
    def rx_circuit(theta):
        pennylane.RX(theta, wires=0)
        return pennylane.state()
    
    state = np.array(rx_circuit(np.pi))
    
    # RX(π) = -iX|0⟩ = -i|1⟩
    expected = np.array([0, -1j])
    
    assert_state_fidelity_above(state, expected, threshold=0.99)


@pytest.mark.pennylane
def test_pennylane_hadamard_state(pennylane_device):
    """Test Hadamard gate creates superposition."""
    pennylane = pytest.importorskip("pennylane")
    
    dev = pennylane_device(wires=1)
    
    @pennylane.qnode(dev)
    def h_circuit():
        pennylane.Hadamard(wires=0)
        return pennylane.state()
    
    state = np.array(h_circuit())
    
    # |+⟩ = (|0⟩ + |1⟩) / √2
    expected = np.array([1, 1]) / np.sqrt(2)
    
    assert_state_fidelity_above(state, expected, threshold=0.999)
    assert_normalized(state)


@pytest.mark.pennylane
def test_pennylane_expectation_value(pennylane_device):
    """Test expectation value computation."""
    pennylane = pytest.importorskip("pennylane")
    
    dev = pennylane_device(wires=1)
    
    @pennylane.qnode(dev)
    def expectation_circuit():
        pennylane.Hadamard(wires=0)
        return pennylane.expval(pennylane.PauliZ(0))
    
    result = expectation_circuit()
    
    # ⟨+|Z|+⟩ = 0
    assert_expectation_value_close(result, 0.0, atol=0.01)


@pytest.mark.pennylane
def test_pennylane_entangled_state(pennylane_device):
    """Test Bell state preparation in PennyLane."""
    pennylane = pytest.importorskip("pennylane")
    
    dev = pennylane_device(wires=2)
    
    @pennylane.qnode(dev)
    def bell_circuit():
        pennylane.Hadamard(wires=0)
        pennylane.CNOT(wires=[0, 1])
        return pennylane.state()
    
    state = np.array(bell_circuit())
    
    # |Φ+⟩ = (|00⟩ + |11⟩) / √2
    expected = np.array([1, 0, 0, 1]) / np.sqrt(2)
    
    assert_state_fidelity_above(state, expected, threshold=0.999)
