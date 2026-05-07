import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "RaceSense AI | Pit Wall Strategy Copilot",
  description: "Next-generation AI racing strategy assistant powered by IBM Granite and Docling.",
  keywords: ["F1", "AI", "Racing", "Strategy", "IBM Granite", "Docling", "Data Analytics"],
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className={inter.className}>{children}</body>
    </html>
  );
}
