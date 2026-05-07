"""
Comprehensive fixtures for quantum testing across multiple frameworks.
"""

import pytest


def _optional_import(module_name, package=None):
    """Try to import a module, returning None if not available."""
    try:
        return __import__(module_name, fromlist=[package] if package else [])
    except ImportError:
        return None


def quantum_hardware_info():
    """Get information about available quantum frameworks."""
    frameworks = {
        "qiskit": _optional_import("qiskit"),
        "cirq": _optional_import("cirq"),
        "pennylane": _optional_import("pennylane"),
        "braket": _optional_import("braket"),
        "graphix": _optional_import("graphix"),
        "pytket": _optional_import("pytket"),
        "stim": _optional_import("stim"),
        "qutip": _optional_import("qutip"),
        "tequila": _optional_import("tequila"),
        "mitiq": _optional_import("mitiq"),
    }
    return {name: bool(lib) for name, lib in frameworks.items()}


# =============================================================================
# Qiskit / Aer Fixtures
# =============================================================================


@pytest.fixture
def aer_simulator(request):
    """Aer simulator backend fixture."""
    qiskit = _optional_import("qiskit")
    if qiskit is None:
        pytest.skip("Qiskit is not installed")
    try:
        from qiskit_aer import AerSimulator
        return AerSimulator()
    except ImportError:
        pytest.skip("qiskit-aer is not installed")


@pytest.fixture
def aer_statevector_simulator(request):
    """Aer statevector simulator backend fixture."""
    qiskit = _optional_import("qiskit")
    if qiskit is None:
        pytest.skip("Qiskit is not installed")
    try:
        from qiskit_aer import AerSimulator
        return AerSimulator(method="statevector")
    except ImportError:
        pytest.skip("qiskit-aer is not installed")


@pytest.fixture
def aer_noise_simulator(request):
    """Factory for Aer noise simulator."""
    qiskit = _optional_import("qiskit")
    if qiskit is None:
        pytest.skip("Qiskit is not installed")
    try:
        from qiskit_aer import AerSimulator
        from qiskit_aer.noise import NoiseModel

        def make_simulator(error_rate=0.001):
            noise_model = NoiseModel()
            noise_model.add_all_qubit_quantum_error(
                [[1 - error_rate, error_rate], [error_rate, 1 - error_rate]],
                ['x', 'h', 'cx']
            )
            return AerSimulator(noise_model=noise_model)

        return make_simulator
    except ImportError:
        pytest.skip("qiskit-aer is not installed")


@pytest.fixture
def qiskit_sampler(request):
    """Qiskit StatevectorSampler fixture."""
    try:
        from qiskit.primitives import StatevectorSampler
        return StatevectorSampler()
    except ImportError:
        pytest.skip("Qiskit 1.0+ primitives not available")


@pytest.fixture
def qiskit_estimator(request):
    """Qiskit StatevectorEstimator fixture."""
    try:
        from qiskit.primitives import StatevectorEstimator
        return StatevectorEstimator()
    except ImportError:
        pytest.skip("Qiskit 1.0+ primitives not available")


@pytest.fixture
def ibm_backend(request):
    """IBM Quantum backend fixture (requires --quantum-real)."""
    try:
        from qiskit_ibm_runtime import QiskitRuntimeService
        
        config = request.config
        if not config.getoption("--quantum-real"):
            pytest.skip("Use --quantum-real to run hardware tests")
        
        service = QiskitRuntimeService()
        return service.least_busy(operational=True, simulator=False)
    except ImportError:
        pytest.skip("qiskit-ibm-runtime not installed")
    except Exception as e:
        pytest.skip(f"Could not access IBM Quantum: {e}")


# =============================================================================
# Cirq Fixtures
# =============================================================================


@pytest.fixture
def cirq_simulator(request):
    """Cirq simulator fixture."""
    cirq = _optional_import("cirq")
    if cirq is None:
        pytest.skip("Cirq is not installed")
    return cirq.Simulator()


@pytest.fixture
def cirq_sampler(request):
    """Factory for Cirq sampling function."""
    cirq = _optional_import("cirq")
    if cirq is None:
        pytest.skip("Cirq is not installed")
    
    simulator = cirq.Simulator()
    
    def run_fn(circuit, shots=1000):
        results = simulator.run(circuit, repetitions=shots)
        # Convert to counts format
        counts = {}
        for key, value in results.multi_measurement_histogram(keys=circuit.all_measurement_key_names()).items():
            bitstring = ''.join(str(int(k)) for k in key)
            counts[bitstring] = value
        return counts
    
    return run_fn


# =============================================================================
# PennyLane Fixtures
# =============================================================================


@pytest.fixture
def pennylane_device(request):
    """Factory for PennyLane devices."""
    qml = _optional_import("pennylane")
    if qml is None:
        pytest.skip("PennyLane is not installed")

    def make_device(wires, shots=None):
        return qml.device("default.qubit", wires=wires, shots=shots)

    return make_device


# =============================================================================
# Amazon Braket Fixtures
# =============================================================================


@pytest.fixture
def braket_simulator(request):
    """Amazon Braket local simulator fixture."""
    try:
        from braket.devices import LocalSimulator
        return LocalSimulator()
    except ImportError:
        pytest.skip("Amazon Braket SDK not installed")


@pytest.fixture
def braket_cloud_device(request):
    """Amazon Braket cloud device fixture (requires --quantum-real)."""
    try:
        from braket.aws import AwsDevice
        
        config = request.config
        if not config.getoption("--quantum-real"):
            pytest.skip("Use --quantum-real to run cloud tests")
        
        # Get available devices
        devices = AwsDevice.get_devices(statuses=['ONLINE'])
        return devices[0] if devices else pytest.skip("No online Braket devices")
    except ImportError:
        pytest.skip("Amazon Braket SDK not installed")
    except Exception as e:
        pytest.skip(f"Could not access Braket: {e}")


# =============================================================================
# Graphix Fixtures
# =============================================================================


@pytest.fixture
def graphix_backend(request):
    """Graphix MBQC backend fixture."""
    try:
        import graphix
        from graphix.pauli import Prep, Measure
        
        class GraphixRunner:
            def run_pattern(self, pattern):
                # Simplified execution
                return pattern
        
        return GraphixRunner()
    except ImportError:
        pytest.skip("Graphix not installed")


# =============================================================================
# Pytket Fixtures
# =============================================================================


@pytest.fixture
def pytket_circuit_factory(request):
    """Factory for Pytket circuits."""
    try:
        from pytket import Circuit
        return Circuit
    except ImportError:
        pytest.skip("Pytket not installed")


# =============================================================================
# Stim Fixtures
# =============================================================================


@pytest.fixture
def stim_sampler(request):
    """Factory for Stim sampling."""
    try:
        import stim
        
        def sample_fn(circuit, shots=1000):
            sampler = circuit.compile_sampler()
            return sampler.sample(shots=shots)
        
        return sample_fn
    except ImportError:
        pytest.skip("Stim not installed")


# =============================================================================
# QuTiP Fixtures
# =============================================================================


@pytest.fixture
def qutip_solver(request):
    """QuTiP solver fixture."""
    try:
        import qutip
        
        def solve(H, psi0, tlist, c_ops=None):
            result = qutip.mesolve(H, psi0, tlist, c_ops=c_ops)
            return result
        
        return solve
    except ImportError:
        pytest.skip("QuTiP not installed")


# =============================================================================
# Tequila Fixtures
# =============================================================================


@pytest.fixture
def tequila_backend(request):
    """Tequila backend fixture."""
    try:
        import tequila
        return tequila
    except ImportError:
        pytest.skip("Tequila not installed")


# =============================================================================
# Hardware Fixtures
# =============================================================================


@pytest.fixture
def ionq_backend(request):
    """IonQ backend fixture (requires --quantum-real)."""
    try:
        from qiskit_ionq import IonQProvider
        
        config = request.config
        if not config.getoption("--quantum-real"):
            pytest.skip("Use --quantum-real to run hardware tests")
        
        provider = IonQProvider()
        return provider.get_backend("ionq_simulator")  # or ionq_qpu
    except ImportError:
        pytest.skip("qiskit-ionq not installed")


@pytest.fixture
def quantinuum_backend(request):
    """Quantinuum backend fixture (requires --quantum-real)."""
    try:
        from pytket.extensions.quantinuum import QuantinuumBackend
        
        config = request.config
        if not config.getoption("--quantum-real"):
            pytest.skip("Use --quantum-real to run hardware tests")
        
        return QuantinuumBackend(device_name="H1-1E")
    except ImportError:
        pytest.skip("pytket-quantinuum not installed")


# =============================================================================
# Utility Fixtures
# =============================================================================


@pytest.fixture
def quantum_shots(request):
    """Get shot count from CLI option."""
    return request.config.getoption("--quantum-shots")


@pytest.fixture
def quantum_significance(request):
    """Get significance level from CLI option."""
    return request.config.getoption("--quantum-significance")


@pytest.fixture
def shot_budget(request):
    """Global shot budget tracker."""
    class ShotBudget:
        def __init__(self):
            self.used = 0
            self.limit = request.config.getoption("--quantum-shots") or float('inf')
        
        def allocate(self, requested):
            if self.used + requested > self.limit:
                available = self.limit - self.used
                if available <= 0:
                    pytest.skip("Shot budget exhausted")
                return int(available)
            self.used += requested
            return requested
    
    return ShotBudget()


@pytest.fixture
def multi_backend_runner(request):
    """Fixture for running circuits on multiple backends in parallel."""
    from concurrent.futures import ThreadPoolExecutor
    
    class MultiBackendRunner:
        def __init__(self):
            self.backends = {}
        
        def add_backend(self, name, backend):
            self.backends[name] = backend
        
        def run_parallel(self, circuit_fn, shots=1000):
            """Run circuit on all backends in parallel."""
            with ThreadPoolExecutor() as executor:
                futures = {
                    name: executor.submit(circuit_fn, backend, shots)
                    for name, backend in self.backends.items()
                }
                return {name: future.result() for name, future in futures.items()}
        
        def compare_results(self, results, tolerance=0.05):
            """Compare results across backends."""
            from .statistics import tvd_from_counts
            
            names = list(results.keys())
            for i, name_a in enumerate(names):
                for name_b in names[i+1:]:
                    tvd = tvd_from_counts(results[name_a], results[name_b])
                    if tvd > tolerance:
                        raise AssertionError(
                            f"Results differ between {name_a} and {name_b}: TVD={tvd:.4f}"
                        )
    
    return MultiBackendRunner()


@pytest.fixture
def benchmark_suite(request):
    """Benchmark timing wrapper for assertions."""
    import time
    
    class BenchmarkSuite:
        def __init__(self):
            self.timings = {}
        
        def time_assertion(self, assertion_fn, *args, **kwargs):
            start = time.perf_counter()
            result = assertion_fn(*args, **kwargs)
            elapsed = time.perf_counter() - start
            name = assertion_fn.__name__
            self.timings[name] = self.timings.get(name, []) + [elapsed]
            return result
        
        def report(self):
            for name, times in self.timings.items():
                avg = sum(times) / len(times)
                print(f"{name}: {avg:.4f}s avg over {len(times)} calls")
    
    return BenchmarkSuite()


@pytest.fixture
def quantum_hardware_info_fixture(request):
    """Fixture version of quantum hardware info."""
    return quantum_hardware_info()
