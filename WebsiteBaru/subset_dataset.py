import pandas as pd

"""Script Python: subset_dataset.py

Penggunaan:
  python subset_dataset.py input.csv output.csv --percent 30 --random-state 42
"""
import argparse


def parse_args():
    parser = argparse.ArgumentParser(description='Ambil subset dari dataset untuk ML.')
    parser.add_argument('input', help='Path file CSV input')
    parser.add_argument('output', help='Path file CSV output')
    parser.add_argument('--percent', type=int, default=30, help='Persentase subset (10-100)')
    parser.add_argument('--random-state', type=int, default=42, help='Seed untuk shuffle')
    return parser.parse_args()


def main():
    args = parse_args()
    if args.percent < 10 or args.percent > 100:
        raise ValueError('persentase harus antara 10 dan 100')

    df = pd.read_csv(args.input)
    subset_size = max(1, int(len(df) * args.percent / 100))
    subset = df.sample(n=subset_size, random_state=args.random_state)
    subset.to_csv(args.output, index=False)

    print(f'Input rows: {len(df)}')
    print(f'Subset rows: {len(subset)} ({args.percent}%)')


if __name__ == '__main__':
    main()
