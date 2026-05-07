from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from doc_processor import processor
import uvicorn

app = FastAPI(title="RaceSense AI Backend")

# Enable CORS for Next.js frontend
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["*"],
    allow_headers=["*"],
)

class AnalysisRequest(BaseModel):
    url: str = "https://www.fia.com/sites/default/files/fia_2024_formula_1_sporting_regulations_-_issue_6_-_2024-04-30.pdf"

@app.get("/")
async def root():
    return {"message": "RaceSense AI API is running"}

@app.post("/analyze-regulations")
async def analyze_regulations(request: AnalysisRequest):
    try:
        # Use IBM Docling to parse the regulations
        markdown_content = processor.convert_url(request.url)
        
        # Here we would normally pass this to IBM Granite via Ollama
        # For the prototype, we'll return the parsed structure and a mock AI insight
        return {
            "status": "success",
            "source": request.url,
            "parsed_content": markdown_content[:2000],  # Return snippet for preview
            "ai_insight": "Based on the Sporting Regulations, pit lane entry speed is strictly monitored. Ensure your strategy accounts for the 80km/h limit to avoid penalties."
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=8000)
