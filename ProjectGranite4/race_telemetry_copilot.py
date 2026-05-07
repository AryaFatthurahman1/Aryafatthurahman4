import os
from typing import List

from langchain.embeddings import HuggingFaceEmbeddings
from langchain.schema import Document
from langchain.vectorstores import Chroma

USE_GRANITE = False

SAMPLE_TELEMETRY_NOTES = [
    {
        "id": "note-1",
        "text": "Car 7 ran consistent 1:28.4 lap times on medium tires and showed strong pace in sector 1.",
    },
    {
        "id": "note-2",
        "text": "Car 12 lost 2.8 seconds in sector 3 due to traffic and then entered the pits at lap 14.",
    },
    {
        "id": "note-3",
        "text": "Pit stop at lap 21 for car 7 used hard tires and improved durability for the final stint.",
    },
    {
        "id": "note-4",
        "text": "A safety car on lap 18 compressed the field and changed the optimal tire strategy for all leading cars.",
    },
    {
        "id": "note-5",
        "text": "Telemetry showed elevated brake temperature on car 3 during the final two laps, suggesting a conservative attack mode.",
    },
]


def build_vector_store(notes: List[dict]) -> Chroma:
    """Build a Chroma vector store from racing telemetry notes."""
    embeddings = HuggingFaceEmbeddings(model_name="sentence-transformers/all-MiniLM-L6-v2")
    documents = [
        Document(page_content=note["text"], metadata={"note_id": note["id"]})
        for note in notes
    ]
    vector_db = Chroma.from_documents(documents, embeddings)
    return vector_db


def answer_question(question: str, vector_db: Chroma) -> str:
    """Answer a natural language question using retrieval over telemetry notes."""
    retriever = vector_db.as_retriever(search_type="similarity", search_kwargs={"k": 3})
    docs = retriever.get_relevant_documents(question)
    if not docs:
        return "No relevant telemetry notes were found."

    response = [f"Relevant note {i+1}: {doc.page_content}" for i, doc in enumerate(docs)]
    return "\n\n".join(response)


def parse_pdf_with_docling(pdf_path: str) -> List[Document]:
    """Optional helper: parse a PDF into documents using Docling."""
    from docling.datamodel.base_models import InputFormat
    from docling.datamodel.pipeline_options import PdfPipelineOptions
    from docling.document_converter import DocumentConverter, PdfFormatOption
    from urllib.parse import urlparse

    pdf_pipeline_options = PdfPipelineOptions(do_ocr=False, generate_picture_images=True)
    format_options = {
        InputFormat.PDF: PdfFormatOption(pipeline_options=pdf_pipeline_options),
    }
    converter = DocumentConverter(format_options=format_options)
    document = converter.convert(source=pdf_path).document

    texts = []
    for item in document.pages[0].items:
        text = getattr(item, "text", None)
        if text:
            texts.append(Document(page_content=text, metadata={"ref": item.get_ref().cref}))

    return texts


def main() -> None:
    print("Race Telemetry Copilot prototype starting...")
    vector_db = build_vector_store(SAMPLE_TELEMETRY_NOTES)

    print("Built vector store with sample telemetry notes.")
    print("You can now ask questions such as:")
    print("- Which car had the fastest sector 1 pace?")
    print("- What was the effect of the lap 18 safety car?")
    print("- When did car 7 pit and what tire choice was used?")
    print("\n")

    while True:
        question = input("Enter a question (or type 'exit'): ").strip()
        if question.lower() in {"exit", "quit"}:
            print("Exiting the telemetry copilot.")
            break
        answer = answer_question(question, vector_db)
        print("\n---\n")
        print(answer)
        print("\n---\n")


if __name__ == "__main__":
    main()
