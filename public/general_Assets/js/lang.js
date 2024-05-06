function toggleLanguage() {
  const toggleSwitch = document.getElementById('language-toggle');
  const form = document.getElementById('language-form');

  if (toggleSwitch.checked) {
      form.action = "/Healwave/dashboard/np";

  } else {
      form.action = "/Healwave/dashboard/en";
  }

  form.submit();
}