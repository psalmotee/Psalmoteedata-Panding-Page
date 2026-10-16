import { useNavigate } from "react-router-dom";
import logo from "../assets/psalmoteedata-logo.png";
import {
  FaFacebook,
  FaInstagram,
  FaEnvelope,
  FaPhone,
  FaMapPin,
  FaClock,
  FaHeart,
} from "react-icons/fa";

const SERVICES_LINKS = [
  {
    label: "Airtime Recharge",
    href: "https://psalmoteedata.com.ng/vpaccount/airtime",
  },
  {
    label: "Data Bundles",
    href: "https://psalmoteedata.com.ng/vpaccount/-data",
  },
  {
    label: "Electricity Tokens",
    href: "https://psalmoteedata.com.ng/vpaccount/-bill",
  },
  { label: "Cable TV", href: "https://psalmoteedata.com.ng/vpaccount/-cable" },
];

const COMPANY_LINKS = [
  { label: "About Us", path: "/about" },
  { label: "FAQs", path: "/faq" },
  { label: "Contact", path: "/contact" },
  { label: "Privacy Policy", path: "/privacy" },
  { label: "Terms of Service", path: "/terms" },
];

const SOCIALS = [
  { label: <FaFacebook />, href: "#" },
  { label: <FaInstagram />, href: "#" },
  // { label: 'in', href: '#' },
  // { label: '▶',  href: '#' },
];

const CONTACTS = [
  {
    icon: FaEnvelope,
    href: "mailto:psalmoteetelecoms@gmail.com",
    text: "psalmoteetelecoms@gmail.com",
  },
  { icon: FaPhone, href: "tel:+2348058461612", text: "+234 805 846 1612" },
  { icon: FaMapPin, href: "#", text: "Ibadan, Nigeria" },
  { icon: FaClock, text: "Available 24/7" },
];

export default function Footer() {
  const navigate = useNavigate();
  return (
    <footer
      id="contact"
      className="bg-card2 border-t border-[var(--border)] pt-16 pb-8 px-5"
    >
      <div className="max-w-[1200px] mx-auto">
        {/* ── Grid ── */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">
          {/* Brand column */}
          <div>
            <button
              onClick={() => {
                navigate("/");
                window.scrollTo({ top: 0 });
              }}
              className="inline-flex items-center gap-2.5 no-underline mb-4 bg-none border-none cursor-pointer p-0"
            >
              <img
                src={logo}
                alt="PsalmoteeData"
                className="w-9 h-9 object-contain"
              />
              <span className="font-display font-bold text-[1.1rem] gradient-text">
                PsalmoteeData
              </span>
            </button>
            <p className="text-muted text-sm leading-relaxed max-w-[240px]">
              Nigeria's trusted platform for instant airtime, data, electricity,
              and bill payments. Fast, secure, and always available.
            </p>
            {/* Social links */}
            <div className="flex gap-2.5 mt-5">
              {SOCIALS.map((s) => (
                <a
                  key={s.label}
                  href={s.href}
                  className="
                    w-9 h-9 rounded-[10px] border border-[var(--border)]
                    flex items-center justify-center
                    text-muted text-2xl no-underline
                    hover:border-primary hover:text-primary hover:bg-primary/10
                    transition-all duration-200
                  "
                >
                  {s.label}
                </a>
              ))}
            </div>
          </div>

          {/* Services */}
          <div>
            <h4 className="font-display font-semibold text-sm mb-5 text-[var(--text)]">
              Services
            </h4>
            {SERVICES_LINKS.map((l) => (
              <a
                key={l.label}
                href={l.href}
                className="
                  block text-muted text-sm mb-3 no-underline
                  hover:text-primary transition-colors duration-200
                "
              >
                {l.label}
              </a>
            ))}
          </div>

          {/* Company */}
          <div>
            <h4 className="font-display font-semibold text-sm mb-5 text-[var(--text)]">
              Company
            </h4>
            {COMPANY_LINKS.map((l) => (
              <a
                key={l.label}
                onClick={() => {
                  navigate(l.path);
                  window.scrollTo({ top: 0 });
                }}
                className="
                  block text-muted text-sm mb-3 no-underline
                  hover:text-primary transition-colors duration-200
                  bg-none border-none cursor-pointer p-0 text-left
                "
              >
                {l.label}
              </a>
            ))}
          </div>

          {/* Contact */}
          <div>
            <h4 className="font-display font-semibold text-sm mb-5 text-[var(--text)]">
              Contact
            </h4>
            {CONTACTS.map((c, i) => (
              <div key={i} className="mb-3.5">
                <a
                  href={c.href}
                  className="text-muted text-sm leading-snug no-underline hover:text-primary flex gap-2.5 transition-colors duration-200"
                >
                  <c.icon className="text-base flex-shrink-0" />
                  <span>{c.text}</span>
                </a>
              </div>
            ))}
          </div>
        </div>

        {/* ── Bottom bar ── */}
        <div
          className="
          border-t border-[var(--border)] pt-6
          flex flex-wrap items-center justify-between gap-3
        "
        >
          <p className="text-muted text-xs">
            © {new Date().getFullYear()} PsalmoteeData. All rights reserved.
          </p>
          <p className="text-muted text-xs flex items-center justify-center gap-1">
            Built with <FaHeart className="text-red-500" /> Psalmotee Tech
          </p>
        </div>
      </div>
    </footer>
  );
}
