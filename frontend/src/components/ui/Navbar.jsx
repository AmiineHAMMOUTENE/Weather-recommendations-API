import { useEffect, useState } from "react";
import { Sun, Moon } from "lucide-react";

function Navbar() {
  const [darkMode, setDarkMode] = useState(
    localStorage.getItem("theme") === "dark"
  );

  useEffect(() => {
    const root = document.documentElement;
    if (darkMode) {
      root.classList.add("dark");
      localStorage.setItem("theme", "dark");
    } else {
      root.classList.remove("dark");
      localStorage.setItem("theme", "light");
    }
  }, [darkMode]);

  return (
    <nav className="w-full px-6 py-4 bg-white dark:bg-gray-800 shadow flex justify-between items-center">
      <h1 className="text-xl font-bold text-gray-900 dark:text-white">
        Recommandations météo
      </h1>
      <button
        onClick={() => setDarkMode(!darkMode)}
        className="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
        aria-label="Toggle Theme"
      >
        {darkMode ? <Sun className="text-yellow-400" /> : <Moon className="text-blue-500" />}
      </button>
    </nav>
  );
}

export default Navbar;
