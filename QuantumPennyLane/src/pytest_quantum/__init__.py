"""
pytest-quantum: A cross-framework pytest plugin for quantum program testing.

Version: 1.0.0

Provides 80+ assertions for testing quantum circuits across multiple frameworks
including Qiskit, Cirq, PennyLane, Amazon Braket, Graphix, Pytket, Stim,
QuTiP, Tequila, and Mitiq.
"""

# Core assertions (80+)
from .assertions import (
    # State assertions
    assert_normalized,
    assert_state_fidelity_above,
    assert_states_close,
    assert_bloch_sphere_close,
    
    # Unitary and circuit equivalence
    assert_unitary,
    assert_circuits_equivalent,
    assert_transpilation_preserves_semantics,
    assert_cross_platform_equivalent,
    assert_qiskit_cirq_equivalent,
    assert_qiskit_pytket_equivalent,
    
    # Measurement distributions
    assert_measurement_distribution,
    assert_counts_close,
    assert_hellinger_close,
    assert_kl_divergence_below,
    assert_cross_entropy_below,
    assert_real_counts_close,
    
    # Density matrix assertions
    assert_density_matrix_close,
    assert_trace_distance_below,
    assert_purity_above,
    assert_partial_trace_close,
    
    # Quantum channel assertions
    assert_hermitian,
    assert_positive_semidefinite,
    assert_commutes_with,
    assert_channel_is_cptp,
    assert_process_fidelity_above,
    assert_noise_fidelity_above,
    
    # Noise channel assertions (v1.0.0)
    assert_depolarizing_channel,
    assert_amplitude_damping_channel,
    assert_dephasing_channel,
    assert_no_leakage,
    assert_channel_preserves_trace,
    assert_channel_diamond_norm_below,
    
    # Entanglement assertions
    assert_entanglement_entropy_below,
    assert_schmidt_rank_at_most,
    
    # Observable and expectation value
    assert_expectation_value_close,
    assert_ground_state_energy_close,
    assert_vqe_converges,
    assert_cost_decreases,
    
    # Qiskit primitives
    assert_sampler_distribution,
    assert_estimator_close,
    
    # Circuit structure
    assert_circuit_depth,
    assert_circuit_width,
    assert_gate_count,
    assert_gates_in_basis_set,
    assert_circuit_is_clifford,
    assert_has_diagram,
    assert_no_mid_circuit_measurement,
    
    # Transpilation / compilation
    assert_transpilation_equivalent,
    assert_transpilation_depth_below,
    assert_gate_count_after_transpilation,
    
    # Sweeps / parametrised circuits
    assert_circuit_sweep,
    assert_circuit_sweep_states,
    assert_parametrized_unitary_continuous,
    
    # Snapshots / golden-file testing
    assert_unitary_snapshot,
    assert_distribution_snapshot,
    
    # QASM round-trips
    assert_qasm_roundtrip,
    assert_qasm2_roundtrip,
    
    # QEC / Stim
    assert_stim_logical_error_rate_below,
    assert_stim_detector_error_rate_below,
    assert_stabilizer_state,
    
    # Benchmarking (v1.0.0)
    assert_quantum_volume,
    assert_randomized_benchmarking,
    assert_t1_above,
    assert_t2_above,
    assert_t2star_above,
    assert_interleaved_rb,
    assert_gate_fidelity_above,
    
    # Quantum ML (v1.0.0)
    assert_xeb_fidelity_above,
    assert_expressibility_above,
    assert_entanglement_capability_above,
    assert_no_barren_plateau,
    
    # Hardware assertions (v1.0.0)
    assert_backend_calibration,
    assert_backend_executes,
    assert_circuit_fits_backend,
    assert_mirror_fidelity,
    
    # Mitiq error mitigation
    assert_zne_expectation_close,
    assert_zne_reduces_error,
    assert_cdr_reduces_error,
    assert_mitigation_improves_fidelity,
    assert_pec_reduces_error,
    assert_pec_expectation_close,
    assert_error_mitigation_benchmark,
)

# Statistical utilities
from .statistics import (
    fidelity,
    probabilities_from_counts,
    chi_square_test,
    tvd,
    tvd_from_counts,
    hellinger_distance,
    kl_divergence,
    cross_entropy,
    von_neumann_entropy,
    min_shots,
    recommended_shots,
    expectation_value_from_counts,
)

# Random generators
from .random import (
    random_statevector,
    random_density_matrix,
    random_unitary,
    random_kraus_channel,
    depolarizing_kraus,
    amplitude_damping_kraus,
    phase_damping_kraus,
    random_hermitian,
    random_observable,
    random_clifford_circuit,
    random_pauli_string,
    random_bitstring,
    random_quantum_circuit,
)

# MQT SyReC integration
from .syrec_integration import (
    SyReCSynthesizer,
    assert_syrec_parses,
    assert_syrec_synthesizes,
    assert_syrec_reversible,
    assert_syrec_simulation_matches,
    assert_syrec_cost_below,
    assert_syrec_cost_aware_better_than_line_aware,
    assert_syrec_equivalent_to_classical,
    SYREC_EXAMPLES,
    REVERSIBLE_BENCHMARKS,
)

# Pytest hooks
from .plugin import (
    pytest_addoption,
    pytest_collection_modifyitems,
    pytest_configure,
    pytest_report_header,
)

# Fixtures are auto-discovered by pytest

__version__ = "1.0.0"
__author__ = "Tejas Ghatule, Quantum Software Team"

__all__ = [
    # Version
    "__version__",
    
    # Core assertions
    "assert_normalized",
    "assert_state_fidelity_above",
    "assert_states_close",
    "assert_bloch_sphere_close",
    "assert_unitary",
    "assert_circuits_equivalent",
    "assert_transpilation_preserves_semantics",
    "assert_cross_platform_equivalent",
    "assert_qiskit_cirq_equivalent",
    "assert_qiskit_pytket_equivalent",
    "assert_measurement_distribution",
    "assert_counts_close",
    "assert_hellinger_close",
    "assert_kl_divergence_below",
    "assert_cross_entropy_below",
    "assert_real_counts_close",
    "assert_density_matrix_close",
    "assert_trace_distance_below",
    "assert_purity_above",
    "assert_partial_trace_close",
    "assert_hermitian",
    "assert_positive_semidefinite",
    "assert_commutes_with",
    "assert_channel_is_cptp",
    "assert_process_fidelity_above",
    "assert_noise_fidelity_above",
    "assert_depolarizing_channel",
    "assert_amplitude_damping_channel",
    "assert_dephasing_channel",
    "assert_no_leakage",
    "assert_channel_preserves_trace",
    "assert_channel_diamond_norm_below",
    "assert_entanglement_entropy_below",
    "assert_schmidt_rank_at_most",
    "assert_expectation_value_close",
    "assert_ground_state_energy_close",
    "assert_vqe_converges",
    "assert_cost_decreases",
    "assert_sampler_distribution",
    "assert_estimator_close",
    "assert_circuit_depth",
    "assert_circuit_width",
    "assert_gate_count",
    "assert_gates_in_basis_set",
    "assert_circuit_is_clifford",
    "assert_has_diagram",
    "assert_no_mid_circuit_measurement",
    "assert_transpilation_equivalent",
    "assert_transpilation_depth_below",
    "assert_gate_count_after_transpilation",
    "assert_circuit_sweep",
    "assert_circuit_sweep_states",
    "assert_parametrized_unitary_continuous",
    "assert_unitary_snapshot",
    "assert_distribution_snapshot",
    "assert_qasm_roundtrip",
    "assert_qasm2_roundtrip",
    "assert_stim_logical_error_rate_below",
    "assert_stim_detector_error_rate_below",
    "assert_stabilizer_state",
    "assert_quantum_volume",
    "assert_randomized_benchmarking",
    "assert_t1_above",
    "assert_t2_above",
    "assert_t2star_above",
    "assert_interleaved_rb",
    "assert_gate_fidelity_above",
    "assert_xeb_fidelity_above",
    "assert_expressibility_above",
    "assert_entanglement_capability_above",
    "assert_no_barren_plateau",
    "assert_backend_calibration",
    "assert_backend_executes",
    "assert_circuit_fits_backend",
    "assert_mirror_fidelity",
    "assert_zne_expectation_close",
    "assert_zne_reduces_error",
    "assert_cdr_reduces_error",
    "assert_mitigation_improves_fidelity",
    "assert_pec_reduces_error",
    "assert_pec_expectation_close",
    "assert_error_mitigation_benchmark",
    
    # Statistical functions
    "fidelity",
    "probabilities_from_counts",
    "chi_square_test",
    "tvd",
    "tvd_from_counts",
    "hellinger_distance",
    "kl_divergence",
    "cross_entropy",
    "von_neumann_entropy",
    "min_shots",
    "recommended_shots",
    "expectation_value_from_counts",
    
    # Random generators
    "random_statevector",
    "random_density_matrix",
    "random_unitary",
    "random_kraus_channel",
    "depolarizing_kraus",
    "amplitude_damping_kraus",
    "phase_damping_kraus",
    "random_hermitian",
    "random_observable",
    "random_clifford_circuit",
    "random_pauli_string",
    "random_bitstring",
    "random_quantum_circuit",
    
    # SyReC integration
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
    
    # Pytest hooks
    "pytest_addoption",
    "pytest_configure",
    "pytest_collection_modifyitems",
    "pytest_report_header",
]
