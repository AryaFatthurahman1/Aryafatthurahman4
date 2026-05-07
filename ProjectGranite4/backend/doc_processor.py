from docling.document_converter import DocumentConverter
import os

class DocProcessor:
    def __init__(self):
        self.converter = DocumentConverter()

    def convert_url(self, url: str):
        """
        Converts a document (PDF/URL) to markdown using IBM Docling.
        """
        result = self.converter.convert(url)
        return result.document.export_to_markdown()

    def convert_file(self, file_path: str):
        """
        Converts a local file to markdown using IBM Docling.
        """
        result = self.converter.convert(file_path)
        return result.document.export_to_markdown()

# Singleton instance
processor = DocProcessor()
