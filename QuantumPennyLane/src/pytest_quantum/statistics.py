"""
Statistical utilities for quantum testing.
"""

import math
from typing import Dict

import numpy as np
from scipy import stats


def fidelity(a, b):
    """Compute fidelity between two states (global phase invariant)."""
    a = np.asarray(a, dtype=complex)
    b = np.asarray(b, dtype=complex)
    overlap = np.vdot(a, b)
    return float(np.abs(overlap) ** 2)


def probabilities_from_counts(counts):
    """Convert counts dictionary to probability distribution."""
    total = sum(counts.values())
    if total == 0:
        raise ValueError("Counts dictionary must contain at least one shot.")
    return {str(k): v / total for k, v in counts.items()}


def chi_square_test(counts, expected_probs):
    """Perform chi-square test on observed counts vs expected probabilities."""
    observed_probs = probabilities_from_counts(counts)
    keys = sorted(set(observed_probs) | set(expected_probs))
    statistic = 0.0
    for key in keys:
        observed = observed_probs.get(key, 0.0)
        expected = expected_probs.get(key, 0.0)
        if expected <= 0:
            continue
        statistic += (observed - expected) ** 2 / expected
    degrees_of_freedom = max(len(keys) - 1, 1)
    p_value = math.exp(-statistic / 2.0)
    return statistic, p_value


def tvd_from_counts(counts_a, counts_b):
    """Compute Total Variation Distance between two count distributions."""
    probs_a = probabilities_from_counts(counts_a)
    probs_b = probabilities_from_counts(counts_b)
    keys = set(probs_a) | set(probs_b)
    return 0.5 * sum(abs(probs_a.get(k, 0.0) - probs_b.get(k, 0.0)) for k in keys)


def tvd(probs_a, probs_b):
    """Compute Total Variation Distance between two probability distributions."""
    keys = set(probs_a) | set(probs_b)
    return 0.5 * sum(abs(probs_a.get(k, 0.0) - probs_b.get(k, 0.0)) for k in keys)


def hellinger_distance(probs_a, probs_b):
    """Compute Hellinger distance between two probability distributions."""
    keys = set(probs_a) | set(probs_b)
    distance = 0.0
    for key in keys:
        p = probs_a.get(key, 0.0)
        q = probs_b.get(key, 0.0)
        distance += (np.sqrt(p) - np.sqrt(q)) ** 2
    return np.sqrt(distance) / np.sqrt(2)


def kl_divergence(p, q):
    """Compute KL divergence D(p||q)."""
    divergence = 0.0
    for key in p:
        p_val = p.get(key, 0.0)
        q_val = q.get(key, 1e-10)  # Avoid log(0)
        if p_val > 0:
            divergence += p_val * np.log(p_val / q_val)
    return divergence


def cross_entropy(p, q):
    """Compute cross entropy H(p, q)."""
    ce = 0.0
    for key in p:
        p_val = p.get(key, 0.0)
        q_val = q.get(key, 1e-10)
        if p_val > 0:
            ce -= p_val * np.log(q_val)
    return ce


def von_neumann_entropy(rho):
    """Compute von Neumann entropy of density matrix."""
    rho = np.asarray(rho, dtype=complex)
    eigenvalues = np.linalg.eigvalsh(rho)
    eigenvalues = eigenvalues[eigenvalues > 0]
    return -np.sum(eigenvalues * np.log2(eigenvalues))


def min_shots(epsilon=0.05, confidence=0.95):
    """Compute minimum shots needed to detect epsilon TVD with given confidence."""
    z = stats.norm.ppf((1 + confidence) / 2)
    n = (z / epsilon) ** 2
    return int(np.ceil(n))


def recommended_shots(expected_probs):
    """Compute recommended shots based on rarest outcome."""
    min_prob = min(expected_probs.values())
    if min_prob == 0:
        return 1000
    return int(np.ceil(10 / min_prob))


def expectation_value_from_counts(counts, observable):
    """Compute expectation value from counts and observable."""
    probs = probabilities_from_counts(counts)
    exp_val = 0.0
    for bitstring, prob in probs.items():
        # Convert bitstring to integer for observable lookup
        idx = int(bitstring, 2)
        exp_val += prob * observable.get(idx, 0)
    return exp_val
