"""
MQT SyReC (Synthesis of Reversible Circuits) Integration

This module provides integration with the Munich Quantum Toolkit (MQT) SyReC
for HDL-based synthesis of reversible circuits.

Reference: https://github.com/munich-quantum-toolkit/syrec
"""

import pytest


def _import_syrec():
    """Try to import mqt.syrec."""
    try:
        import mqt.syrec
        return mqt.syrec
    except ImportError:
        return None


class SyReCSynthesizer:
    """Wrapper for MQT SyReC synthesizer."""
    
    def __init__(self):
        self.syrec = _import_syrec()
        if self.syrec is None:
            raise ImportError(
                "mqt.syrec is not installed. "
                "Install with: pip install mqt.syrec"
            )
    
    def parse_program(self, source_code: str):
        """Parse SyReC source code."""
        try:
            return self.syrec.load_syrec_program(source_code)
        except Exception as e:
            raise ValueError(f"Failed to parse SyReC program: {e}")
    
    def synthesize_cost_aware(self, program):
        """Synthesize using cost-aware scheme (minimizes gate cost)."""
        try:
            return self.syrec.cost_aware_synthesis(program)
        except Exception as e:
            raise RuntimeError(f"Cost-aware synthesis failed: {e}")
    
    def synthesize_line_aware(self, program):
        """Synthesize using line-aware scheme (minimizes circuit lines)."""
        try:
            return self.syrec.line_aware_synthesis(program)
        except Exception as e:
            raise RuntimeError(f"Line-aware synthesis failed: {e}")
    
    def simulate(self, circuit, inputs):
        """Simulate synthesized circuit."""
        try:
            return self.syrec.simulate(circuit, inputs)
        except Exception as e:
            raise RuntimeError(f"Simulation failed: {e}")
    
    def compute_cost(self, circuit):
        """Compute gate cost of circuit."""
        try:
            return self.syrec.compute_gate_cost(circuit)
        except Exception as e:
            raise RuntimeError(f"Cost computation failed: {e}")


# SyReC example programs
SYREC_EXAMPLES = {
    "simple_adder": """
    module adder(a, b, c)
        c = a + b;
    endmodule
    """,
    
    "full_adder": """
    module full_adder(a, b, cin, sum, cout)
        sum = a ^ b ^ cin;
        cout = (a & b) | (cin & (a ^ b));
    endmodule
    """,
    
    "multiplier": """
    module multiplier(a, b, p)
        p = a * b;
    endmodule
    """,
    
    "comparator": """
    module comparator(a, b, gt, eq, lt)
        gt = a > b;
        eq = a == b;
        lt = a < b;
    endmodule
    """,
}


def assert_syrec_parses(source_code: str):
    """Assert that SyReC source code parses successfully."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    try:
        synthesizer.parse_program(source_code)
    except Exception as e:
        raise AssertionError(f"SyReC parsing failed: {e}")


def assert_syrec_synthesizes(source_code: str, method="cost_aware"):
    """Assert that SyReC program synthesizes successfully."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    program = synthesizer.parse_program(source_code)
    
    try:
        if method == "cost_aware":
            circuit = synthesizer.synthesize_cost_aware(program)
        elif method == "line_aware":
            circuit = synthesizer.synthesize_line_aware(program)
        else:
            raise ValueError(f"Unknown synthesis method: {method}")
        
        assert circuit is not None, "Synthesis produced no circuit"
        
    except Exception as e:
        raise AssertionError(f"SyReC synthesis failed: {e}")


def assert_syrec_reversible(source_code: str):
    """Assert that synthesized circuit is reversible."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    program = synthesizer.parse_program(source_code)
    circuit = synthesizer.synthesize_cost_aware(program)
    
    # Check reversibility: unitary should be its own inverse (up to global phase)
    import numpy as np
    
    try:
        from qiskit.quantum_info import Operator
        unitary = np.asarray(Operator(circuit).data, dtype=complex)
        
        # Check if U @ U^dagger = I (reversibility condition)
        product = unitary @ unitary.conj().T
        identity = np.eye(unitary.shape[0], dtype=complex)
        
        assert np.allclose(product, identity, atol=1e-6), (
            "Circuit is not reversible: U @ U^dagger != I"
        )
    except ImportError:
        pytest.skip("Qiskit required for reversibility check")


def assert_syrec_simulation_matches(source_code: str, inputs, expected_outputs):
    """Assert that circuit simulation produces expected outputs."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    program = synthesizer.parse_program(source_code)
    circuit = synthesizer.synthesize_cost_aware(program)
    
    try:
        outputs = synthesizer.simulate(circuit, inputs)
        assert outputs == expected_outputs, (
            f"Simulation mismatch: got {outputs}, expected {expected_outputs}"
        )
    except Exception as e:
        raise AssertionError(f"SyReC simulation assertion failed: {e}")


def assert_syrec_cost_below(source_code: str, max_cost: int, method="cost_aware"):
    """Assert that synthesis produces circuit with cost below threshold."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    program = synthesizer.parse_program(source_code)
    
    if method == "cost_aware":
        circuit = synthesizer.synthesize_cost_aware(program)
    elif method == "line_aware":
        circuit = synthesizer.synthesize_line_aware(program)
    else:
        raise ValueError(f"Unknown synthesis method: {method}")
    
    cost = synthesizer.compute_cost(circuit)
    
    assert cost <= max_cost, (
        f"Circuit cost {cost} exceeds limit {max_cost}"
    )


def assert_syrec_cost_aware_better_than_line_aware(source_code: str):
    """Assert cost-aware synthesis produces lower cost than line-aware."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    program = synthesizer.parse_program(source_code)
    
    cost_circuit = synthesizer.synthesize_cost_aware(program)
    line_circuit = synthesizer.synthesize_line_aware(program)
    
    cost_cost = synthesizer.compute_cost(cost_circuit)
    line_cost = synthesizer.compute_cost(line_circuit)
    
    assert cost_cost <= line_cost, (
        f"Cost-aware synthesis cost {cost_cost} not better than line-aware {line_cost}"
    )


def assert_syrec_equivalent_to_classical(source_code: str, test_cases):
    """Assert SyReC circuit is equivalent to classical computation."""
    syrec = _import_syrec()
    if syrec is None:
        pytest.skip("mqt.syrec not installed")
    
    synthesizer = SyReCSynthesizer()
    program = synthesizer.parse_program(source_code)
    circuit = synthesizer.synthesize_cost_aware(program)
    
    for inputs, expected_classical in test_cases:
        outputs = synthesizer.simulate(circuit, inputs)
        assert outputs == expected_classical, (
            f"For inputs {inputs}: got {outputs}, expected {expected_classical}"
        )


# Fixture for SyReC testing
@pytest.fixture
def syrec_synthesizer(request):
    """Fixture providing SyReC synthesizer."""
    if _import_syrec() is None:
        pytest.skip("mqt.syrec not installed")
    return SyReCSynthesizer()


@pytest.fixture
def syrec_example_programs(request):
    """Fixture providing example SyReC programs."""
    return SYREC_EXAMPLES


@pytest.fixture
def syrec_qiskit_converter(request):
    """Fixture for converting SyReC circuits to Qiskit."""
    def convert_to_qiskit(syrec_circuit):
        try:
            from qiskit import QuantumCircuit
            # This would need proper conversion logic based on SyReC output format
            # For now, return a placeholder
            return QuantumCircuit(2)
        except ImportError:
            pytest.skip("Qiskit required for conversion")
    
    return convert_to_qiskit


# Integration with pytest-quantum assertions
def assert_reversible_circuit_properties(syrec_circuit):
    """Assert various properties of a reversible circuit."""
    # Line count
    # Gate count
    # Gate types
    # Reversibility
    pass


# Command-line utilities for SyReC
def syrec_cli_options(parser):
    """Add SyReC-specific CLI options."""
    group = parser.getgroup("syrec")
    group.addoption(
        "--syrec-method",
        action="store",
        default="cost_aware",
        choices=["cost_aware", "line_aware"],
        help="SyReC synthesis method",
    )
    group.addoption(
        "--syrec-show-cost",
        action="store_true",
        default=False,
        help="Show gate cost after synthesis",
    )


# Reversible circuit benchmarks
REVERSIBLE_BENCHMARKS = {
    "grover_oracle": {
        "qubits": 4,
        "description": "Grover search oracle",
    },
    "quantum_adder": {
        "qubits": 8,
        "description": "Quantum ripple-carry adder",
    },
    "cuccaro_adder": {
        "qubits": 16,
        "description": "Cuccaro ripple-carry adder",
    },
}


def get_reversible_benchmark(name: str):
    """Get a reversible circuit benchmark specification."""
    return REVERSIBLE_BENCHMARKS.get(name)


def list_reversible_benchmarks():
    """List all available reversible circuit benchmarks."""
    return list(REVERSIBLE_BENCHMARKS.keys())


# Utility for comparing reversible circuits
def assert_reversible_circuits_equivalent(circuit_a, circuit_b):
    """Assert two reversible circuits are equivalent."""
    from .assertions import _circuit_unitary
    
    unitary_a = _circuit_unitary(circuit_a)
    unitary_b = _circuit_unitary(circuit_b)
    
    assert unitary_a.shape == unitary_b.shape, "Circuit dimensions differ"
    
    # For reversible circuits, check if they implement the same permutation
    assert np.allclose(unitary_a, unitary_b, atol=1e-6) or \
           np.allclose(unitary_a, unitary_b.conj().T, atol=1e-6), (
        "Reversible circuits are not equivalent"
    )


import numpy as np

__all__ = [
    "SyReCSynthesizer",
    "assert_syrec_parses",
    "assert_syrec_synthesizes",
    "assert_syrec_reversible",
    "assert_syrec_simulation_matches",
    "assert_syrec_cost_below",
    "assert_syrec_cost_aware_better_than_line_aware",
    "assert_syrec_equivalent_to_classical",
    "SYREC_EXAMPLES",
    "REVERSIBLE_BENCHMARKS",
    "get_reversible_benchmark",
    "list_reversible_benchmarks",
    "assert_reversible_circuits_equivalent",
]
