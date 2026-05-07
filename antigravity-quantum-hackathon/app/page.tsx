import Hero from "@/components/Hero"
import About from "@/components/About"
import Challenges from "@/components/Challenges"
import Prizes from "@/components/Prizes"
import Judges from "@/components/Judges"
import Agenda from "@/components/Agenda"
import FAQ from "@/components/FAQ"

export default function Home() {
  return (
    <main>
      <Hero />
      <About />
      <Challenges />
      <Prizes />
      <Judges />
      <Agenda />
      <FAQ />
    </main>
  )
}
