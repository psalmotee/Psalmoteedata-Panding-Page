import { useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { motion, AnimatePresence } from "framer-motion";
import { Menu, X, ChevronRight } from "lucide-react";
import logo from "../assets/psalmoteedata-logo.png";

const NAV_LINKS = [
  { key: "home", label: "Home", path: "/" },
  { key: "faq", label: "FAQs", path: "/faq" },
  { key: "contact", label: "Contact", path: "/contact" },
  { key: "about", label: "About", path: "/about" },
];

const LINKS = {
  login: "https://psalmoteedata.com.ng/vpaccount/",
  register: "https://psalmoteedata.com.ng/vpaccount/?register",
  guest: "https://psalmoteedata.com.ng/vpaccount-offline-2",
};

export default function Header() {
  const [scrolled, setScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const location = useLocation();
  const navigate = useNavigate();

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  // Close drawer on resize to desktop
  useEffect(() => {
    const onResize = () => {
      if (window.innerWidth >= 768) setMenuOpen(false);
    };
    window.addEventListener("resize", onResize);
    return () => window.removeEventListener("resize", onResize);
  }, []);

  const handleNav = (link) => {
    navigate(link.path);
    setMenuOpen(false);
    // Scroll to anchor if on home page
    if (link.key !== "home" && link.path === "/") {
      setTimeout(() => {
        document
          .getElementById(link.key)
          ?.scrollIntoView({ behavior: "smooth" });
      }, 350);
    }
  };

  const isActive = (key) => {
    if (key === "home") return location.pathname === "/";
    // if (key === "faq") return location.pathname === "/faq";
    return location.pathname === `/${key}`;
  };

  return (
    <>
      {/* ── HEADER BAR ── */}
      <header
        className={`
          fixed top-0 left-0 right-0 z-50
          transition-all duration-300
          ${
            scrolled
              ? "bg-bg/95 backdrop-blur-xl border-b border-[var(--border)] shadow-[0_4px_30px_rgba(0,0,0,0.3)]"
              : "bg-transparent"
          }
        `}
      >
        <div className="max-w-[1200px] mx-auto px-5 flex items-center justify-between h-[70px]">
          {/* Logo */}
          <button
            onClick={() => navigate("/")}
            className="flex items-center gap-2.5 no-underline bg-transparent border-none cursor-pointer p-0"
          >
            <img
              src={logo}
              alt="PsalmoteeData"
              className="w-9 h-9 object-contain"
            />
            <span className="font-display font-bold text-[0.8rem] md:text-[1.15rem] gradient-text">
              PsalmoteeData
            </span>
          </button>
          {/* Desktop Nav */}
          <nav className="hidden md:flex items-center gap-9">
            {NAV_LINKS.map((l) => (
              <button
                key={l.key}
                onClick={() => handleNav(l)}
                className={`
        relative text-sm font-medium no-underline
        transition-colors duration-200
        bg-transparent border-none cursor-pointer p-0
        ${
          isActive(l.key)
            ? "text-primary"
            : "text-muted hover:text-[var(--text)]"
        }
      `}
              >
                {l.label}

                {isActive(l.key) && (
                  <motion.span
                    layoutId="nav-underline"
                    className="absolute -bottom-1 left-0 right-0 h-[2px] bg-primary rounded-full"
                  />
                )}
              </button>
            ))}
          </nav>

          {/* Actions */}
          <div className="flex items-center gap-3">
            <a
              href={LINKS.login}
              className="hidden sm:inline-block text-muted hover:text-[var(--text)] text-sm font-medium transition-colors duration-200 no-underline"
            >
              Login
            </a>
            <a
              href={LINKS.register}
              className="
                inline-flex items-center gap-1.5
                bg-gradient-to-r from-primary to-blue
                text-white text-sm font-semibold
                px-5 py-2 rounded-[10px] no-underline
                shadow-[0_4px_15px_rgba(14,165,198,0.3)]
                hover:shadow-[0_6px_22px_rgba(14,165,198,0.45)]
                hover:-translate-y-0.5 transition-all duration-200
              "
            >
              Register
            </a>
            {/* Hamburger */}
            <button
              className="md:hidden p-1.5 text-[var(--text)]"
              onClick={() => setMenuOpen(!menuOpen)}
              aria-label="Toggle menu"
            >
              {menuOpen ? <X size={22} /> : <Menu size={22} />}
            </button>
          </div>
        </div>
      </header>

      {/* ── MOBILE DRAWER ── */}
      <AnimatePresence>
        {menuOpen && (
          <motion.div
            initial={{ x: "-100%" }}
            animate={{ x: 0 }}
            exit={{ x: "-100%" }}
            transition={{ type: "spring", stiffness: 300, damping: 30 }}
            className="
              fixed top-[70px] left-0 right-0 bottom-0 z-40
              bg-bg/98 backdrop-blur-2xl
              border-t border-[var(--border)]
              px-6 pt-8 pb-10
              flex flex-col
              md:hidden
            "
          >
            <nav className="flex flex-col gap-1 mb-8">
              {NAV_LINKS.map((l, i) => (
                <motion.button
                  key={l.key}
                  onClick={() => handleNav(l)}
                  initial={{ opacity: 0, x: -20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ delay: i * 0.07 }}
                  className="
                    flex items-center justify-between py-4 text-lg font-medium no-underline border-0 border-b border-solid border-[var(--border)] text-[var(--text)] hover:text-primary transition-colors duration-200 bg-transparent cursor-pointer w-full text-left
                  "
                >
                  {l.label}
                  <ChevronRight size={16} className="text-muted" />
                </motion.button>
              ))}
            </nav>

            <div className="flex flex-col gap-3 mt-auto">
              <a
                href={LINKS.login}
                className="
                  text-center py-3.5 rounded-[12px]
                  border border-primary text-primary
                  font-semibold text-sm no-underline
                  hover:bg-primary/10 transition-colors
                "
              >
                Login
              </a>
              <a
                href={LINKS.register}
                className="
                  text-center py-3.5 rounded-[12px]
                  bg-gradient-to-r from-primary to-blue
                  text-white font-semibold text-sm no-underline
                  shadow-[0_4px_15px_rgba(14,165,198,0.3)]
                "
              >
                Create Account
              </a>
              <a
                href={LINKS.guest}
                className="
                  text-center text-sm text-muted
                  no-underline hover:text-primary transition-colors
                  mt-1
                "
              >
                Continue as Guest →
              </a>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
