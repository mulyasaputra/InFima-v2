const body = document.querySelector("body");

const thamesConfig = {
  darkIcon: "uil-moon",
  lightIcon: "uil-sun",
  darkMode: "dark",
  closeStatus: "close",
};

function updateThamesIcons(iconClass) {
  const thamesIcons = document.querySelectorAll('.thames-icon');
  thamesIcons.forEach(e => {
    e.classList.replace(thamesConfig.darkIcon, iconClass);
    e.classList.replace(thamesConfig.lightIcon, iconClass);
  });
}

function updateThamesNames(nameText) {
  const thamesNames = document.querySelectorAll('.thames-name');
  thamesNames.forEach(e => {
    e.textContent = nameText;
  });
}

function updateModeAndIcon(isDark) {
  body.classList.toggle("dark", isDark);
  const newIconClass = isDark ? thamesConfig.lightIcon : thamesConfig.darkIcon;
  const newNameText = isDark ? "Light Mode" : "Dark Mode";
  localStorage.setItem("mode", isDark ? thamesConfig.darkMode : "light");
  localStorage.setItem("icon", newIconClass);
  updateThamesIcons(newIconClass);
  updateThamesNames(newNameText);
}

function updateSidebarStatus(isClosed) {
  body.classList.toggle("close", isClosed);
  localStorage.setItem("status", isClosed ? thamesConfig.closeStatus : "open");
}

// Loop melalui elemen-elemen dengan kelas "mode-toggle"
document.querySelectorAll('.mode-toggle').forEach(modeToggle => {
  modeToggle.addEventListener("click", () => {
    const isDarkMode = !body.classList.contains("dark");
    updateModeAndIcon(isDarkMode);
  });
});

document.querySelector('.sidebar-toggle').addEventListener("click", () => {
  const isClosed = !body.classList.contains("close");
  updateSidebarStatus(isClosed);
});

// Initialize based on localStorage values
const storedIcon = localStorage.getItem("icon");
if (storedIcon) {
  updateThamesIcons(storedIcon);
}

const storedMode = localStorage.getItem("mode");
if (storedMode) {
  updateModeAndIcon(storedMode === thamesConfig.darkMode);
}

const storedStatus = localStorage.getItem("status");
if (storedStatus) {
  updateSidebarStatus(storedStatus === thamesConfig.closeStatus);
}

// Bottom Navigation
const navigasiBar = document.querySelector("#BottomNavigation");
let lastScrolly = window.scrollY;

window.addEventListener("scroll", () => {
  if (lastScrolly < window.scrollY) {
    navigasiBar.classList.add("navHidden");
  } else {
    navigasiBar.classList.remove("navHidden");
  }

  lastScrolly = window.scrollY;
});

