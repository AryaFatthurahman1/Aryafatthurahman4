/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
 */

import Navbar from './components/Navbar';
import Hero from './components/Hero';
import Ecosystem from './components/Ecosystem';
import HowItWorks from './components/HowItWorks';
import Features from './components/Features';
import Stakeholders from './components/Stakeholders';
import Jobs from './components/Jobs';
import Testimonials from './components/Testimonials';
import FAQ from './components/FAQ';
import Footer from './components/Footer';

export default function App() {
  return (
    <div className="min-h-screen bg-white font-sans selection:bg-blue-100 selection:text-blue-900">
      <Navbar />
      <main>
        <Hero />
        <Ecosystem />
        <HowItWorks />
        <Features />
        <Stakeholders />
        <Jobs />
        <Testimonials />
        <FAQ />
      </main>
      <Footer />
    </div>
  );
}
