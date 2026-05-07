import type { Metadata } from "next"
import { Inter } from "next/font/google"
import "./globals.css"
import Navigation from "@/components/Navigation"
import Footer from "@/components/Footer"

const inter = Inter({ subsets: ["latin"], variable: "--font-inter" })

export const metadata: Metadata = {
  title: "AntiGravity Quantum Hackathon 2026",
  description: "Where Innovation Meets Entanglement - Join the most exciting quantum computing hackathon",
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="en" className="dark">
      <body className={inter.className}>
        <Navigation />
        <main className="min-h-screen bg-surface-0">{children}</main>
        <Footer />
      </body>
    </html>
  )
}
