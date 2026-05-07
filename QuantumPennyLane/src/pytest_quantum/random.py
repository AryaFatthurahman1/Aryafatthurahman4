"""
Random generators for quantum testing.

Provides utilities for generating random quantum states, unitaries,
Kraus operators, and other quantum objects for testing.
"""

import numpy as np
from scipy import stats


def random_statevector(n_qubits, seed=None):
    """Generate a Haar-random pure statevector.
    
    Args:
        n_qubits: Number of qubits
        seed: Optional random seed
    
    Returns:
        Complex numpy array representing a normalized statevector
    """
    if seed is not None:
        np.random.seed(seed)
    
    dim = 2 ** n_qubits
    # Sample from complex normal distribution
    real_part = np.random.randn(dim)
    imag_part = np.random.randn(dim)
    state = real_part + 1j * imag_part
    
    # Normalize
    return state / np.linalg.norm(state)


def random_density_matrix(n_qubits, rank=None, seed=None):
    """Generate a random density matrix.
    
    Args:
        n_qubits: Number of qubits
        rank: Optional rank constraint (default: full rank)
        seed: Optional random seed
    
    Returns:
        Density matrix as complex numpy array
    """
    if seed is not None:
        np.random.seed(seed)
    
    dim = 2 ** n_qubits
    if rank is None:
        rank = dim
    
    # Generate random pure states and mix them
    rho = np.zeros((dim, dim), dtype=complex)
    probs = np.random.random(rank)
    probs = probs / np.sum(probs)
    
    for p in probs:
        psi = random_statevector(n_qubits)
        rho += p * np.outer(psi, psi.conj())
    
    return rho


def random_unitary(n_qubits, seed=None):
    """Generate a Haar-random unitary matrix.
    
    Args:
        n_qubits: Number of qubits
        seed: Optional random seed
    
    Returns:
        Unitary matrix as complex numpy array
    """
    if seed is not None:
        np.random.seed(seed)
    
    dim = 2 ** n_qubits
    # Generate random complex matrix
    real_part = np.random.randn(dim, dim)
    imag_part = np.random.randn(dim, dim)
    X = (real_part + 1j * imag_part) / np.sqrt(2)
    
    # QR decomposition gives unitary
    Q, R = np.linalg.qr(X)
    
    # Adjust phases to ensure uniqueness
    D = np.diag(R)
    D = D / np.abs(D)
    
    return Q @ np.diag(D)


def random_kraus_channel(n_qubits, n_operators=None, seed=None):
    """Generate a random CPTP channel as Kraus operators.
    
    Args:
        n_qubits: Number of qubits
        n_operators: Number of Kraus operators (default: 4)
        seed: Optional random seed
    
    Returns:
        List of Kraus operators
    """
    if seed is not None:
        np.random.seed(seed)
    
    if n_operators is None:
        n_operators = 4
    
    dim = 2 ** n_qubits
    kraus_ops = []
    
    # Generate random operators and ensure CPTP condition
    for _ in range(n_operators):
        # Random complex matrix
        K = (np.random.randn(dim, dim) + 1j * np.random.randn(dim, dim)) / np.sqrt(2 * n_operators)
        kraus_ops.append(K)
    
    # Normalize to ensure TP condition
    total = sum(K.conj().T @ K for K in kraus_ops)
    normalization = np.linalg.inv(np.linalg.cholesky(total))
    
    return [K @ normalization for K in kraus_ops]


def depolarizing_kraus(p, n_qubits=1):
    """Generate Kraus operators for depolarizing channel.
    
    Args:
        p: Depolarizing probability
        n_qubits: Number of qubits
    
    Returns:
        List of Kraus operators
    """
    dim = 2 ** n_qubits
    
    # K0 = sqrt(1-p) * I
    K0 = np.sqrt(1 - p) * np.eye(dim, dtype=complex)
    
    # For single qubit, remaining operators are Paulis scaled by sqrt(p/3)
    if n_qubits == 1:
        paulis = [
            np.array([[0, 1], [1, 0]], dtype=complex),   # X
            np.array([[0, -1j], [1j, 0]], dtype=complex),  # Y
            np.array([[1, 0], [0, -1]], dtype=complex),  # Z
        ]
        kraus = [K0] + [np.sqrt(p / 3) * sigma for sigma in paulis]
    else:
        # For multi-qubit, use tensor products
        kraus = [K0]
        # Add additional Kraus operators for depolarization
        for i in range(dim):
            op = np.zeros((dim, dim), dtype=complex)
            op[i, i] = np.sqrt(p / (dim * dim - 1))
            kraus.append(op)
    
    return kraus


def amplitude_damping_kraus(gamma):
    """Generate Kraus operators for amplitude damping channel.
    
    Args:
        gamma: Damping probability
    
    Returns:
        List of Kraus operators
    """
    K0 = np.array([[1, 0], [0, np.sqrt(1 - gamma)]], dtype=complex)
    K1 = np.array([[0, np.sqrt(gamma)], [0, 0]], dtype=complex)
    return [K0, K1]


def phase_damping_kraus(lam):
    """Generate Kraus operators for phase damping channel.
    
    Args:
        lam: Phase damping parameter
    
    Returns:
        List of Kraus operators
    """
    K0 = np.array([[1, 0], [0, np.sqrt(1 - lam)]], dtype=complex)
    K1 = np.array([[0, 0], [0, np.sqrt(lam)]], dtype=complex)
    return [K0, K1]


def random_hermitian(n_qubits, seed=None):
    """Generate a random Hermitian matrix.
    
    Args:
        n_qubits: Number of qubits
        seed: Optional random seed
    
    Returns:
        Hermitian matrix as complex numpy array
    """
    if seed is not None:
        np.random.seed(seed)
    
    dim = 2 ** n_qubits
    # Generate random complex matrix
    X = np.random.randn(dim, dim) + 1j * np.random.randn(dim, dim)
    
    # Make Hermitian: H = (X + X^dagger) / 2
    H = (X + X.conj().T) / 2
    
    return H


def random_observable(n_qubits, seed=None):
    """Generate a random observable (Hermitian with eigenvalues in [-1, 1]).
    
    Args:
        n_qubits: Number of qubits
        seed: Optional random seed
    
    Returns:
        Observable as Hermitian matrix
    """
    if seed is not None:
        np.random.seed(seed)
    
    dim = 2 ** n_qubits
    # Random unitary
    U = random_unitary(n_qubits, seed=seed)
    
    # Random diagonal with values in [-1, 1]
    eigenvalues = 2 * np.random.random(dim) - 1
    
    # Construct observable
    return U @ np.diag(eigenvalues) @ U.conj().T


def random_clifford_circuit(n_qubits, depth, seed=None):
    """Generate a random Clifford circuit (requires Qiskit or Cirq).
    
    Args:
        n_qubits: Number of qubits
        depth: Circuit depth
        seed: Optional random seed
    
    Returns:
        Clifford circuit
    """
    if seed is not None:
        np.random.seed(seed)
    
    try:
        from qiskit import QuantumCircuit
        from qiskit.circuit.library import HGate, SGate, CXGate
        
        qc = QuantumCircuit(n_qubits)
        
        clifford_gates = [
            lambda: qc.h(np.random.randint(n_qubits)),
            lambda: qc.s(np.random.randint(n_qubits)),
            lambda: qc.cx(np.random.randint(n_qubits), np.random.randint(n_qubits)),
            lambda: qc.x(np.random.randint(n_qubits)),
            lambda: qc.y(np.random.randint(n_qubits)),
            lambda: qc.z(np.random.randint(n_qubits)),
        ]
        
        for _ in range(depth):
            gate = np.random.choice(clifford_gates)
            gate()
        
        return qc
        
    except ImportError:
        # Fallback without Qiskit
        raise ImportError("Qiskit required for random Clifford circuits")


def random_pauli_string(n_qubits, seed=None):
    """Generate a random Pauli string.
    
    Args:
        n_qubits: Number of qubits
        seed: Optional random seed
    
    Returns:
        Pauli string (e.g., "XIZY")
    """
    if seed is not None:
        np.random.seed(seed)
    
    paulis = ['I', 'X', 'Y', 'Z']
    return ''.join(np.random.choice(paulis) for _ in range(n_qubits))


def random_bitstring(n_bits, seed=None):
    """Generate a random bitstring.
    
    Args:
        n_bits: Number of bits
        seed: Optional random seed
    
    Returns:
        Bitstring as string (e.g., "0101")
    """
    if seed is not None:
        np.random.seed(seed)
    
    return ''.join(str(np.random.randint(2)) for _ in range(n_bits))


def random_quantum_circuit(n_qubits, depth, gate_set=None, seed=None):
    """Generate a random quantum circuit.
    
    Args:
        n_qubits: Number of qubits
        depth: Circuit depth
        gate_set: Optional list of gate names (default: ['h', 'rx', 'ry', 'rz', 'cx'])
        seed: Optional random seed
    
    Returns:
        Quantum circuit (Qiskit format if available)
    """
    if seed is not None:
        np.random.seed(seed)
    
    if gate_set is None:
        gate_set = ['h', 'rx', 'ry', 'rz', 'cx']
    
    try:
        from qiskit import QuantumCircuit
        import qiskit.circuit.library as gates
        
        qc = QuantumCircuit(n_qubits)
        
        for _ in range(depth):
            gate_name = np.random.choice(gate_set)
            
            if gate_name == 'h':
                qc.h(np.random.randint(n_qubits))
            elif gate_name == 'rx':
                qc.rx(np.random.random() * 2 * np.pi, np.random.randint(n_qubits))
            elif gate_name == 'ry':
                qc.ry(np.random.random() * 2 * np.pi, np.random.randint(n_qubits))
            elif gate_name == 'rz':
                qc.rz(np.random.random() * 2 * np.pi, np.random.randint(n_qubits))
            elif gate_name == 'cx':
                q1 = np.random.randint(n_qubits)
                q2 = np.random.randint(n_qubits)
                if q1 != q2:
                    qc.cx(q1, q2)
        
        return qc
        
    except ImportError:
        raise ImportError("Qiskit required for random circuit generation")


__all__ = [
    'random_statevector',
    'random_density_matrix',
    'random_unitary',
    'random_kraus_channel',
    'depolarizing_kraus',
    'amplitude_damping_kraus',
    'phase_damping_kraus',
    'random_hermitian',
    'random_observable',
    'random_clifford_circuit',
    'random_pauli_string',
    'random_bitstring',
    'random_quantum_circuit',
]
