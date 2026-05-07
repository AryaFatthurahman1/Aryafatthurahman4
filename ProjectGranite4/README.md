# Race Telemetry Copilot

This project is a prototype for the IBM SkillsBuild May Challenge: a racing telemetry copilot that uses AI-enabled retrieval to answer questions about race data and strategy.

## What this project includes

- `race_telemetry_copilot.py`: prototype script that builds a vector store from racing telemetry notes and answers natural language queries.
- `requirements.txt`: Python dependencies for embeddings, vector store, and optional IBM Granite integration.

## Core tools used

- `Docling` for document parsing support.
- `LangChain` and `Chroma` for retrieval and embeddings.
- `sentence-transformers` for local embedding generation.
- Optional Granite / Replicate support via `ibm-granite-community`.

## Setup

1. Open PowerShell in this folder: `d:\laragon\www\ProjectGranite4`
2. Create a Python virtual environment:
   ```powershell
   python -m venv .venv
   .\.venv\Scripts\Activate.ps1
   ```
3. Install packages:
   ```powershell
   python -m pip install --upgrade pip
   python -m pip install -r requirements.txt
   ```

## Run the prototype

```powershell
python race_telemetry_copilot.py
```

## Optional Granite / Replicate usage

If you want to use IBM Granite via Replicate, set `REPLICATE_API_TOKEN` in your environment and update the `USE_GRANITE` variable inside `race_telemetry_copilot.py`.

## Project idea

A telemetry copilot can help racing teams answer questions such as:

- "Which driver had the fastest sector 2 laps?"
- "What happened on lap 18 for car 7?"
- "Which pit stop strategy was safest under the safety car?"

This prototype provides the retrieval foundation and can be extended with actual race data, PDF race reports, and Granite-powered natural language generation.
