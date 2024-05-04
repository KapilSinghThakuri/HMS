function toggleLanguage() {
  const toggleSwitch = document.getElementById('language-toggle');
  const form = document.getElementById('language-form');

  // Set route based on the toggle state
  if (toggleSwitch.checked) {
      // If checked, set to Nepali route
      // form.action = "{{ url('set-locale', ['locale' => 'np']) }}";
      form.action = "/Healwave/dashboard/" + "np";

  } else {
      // If not checked, set to English route
      form.action = "/Healwave/dashboard/" + "en";
  }

  // Submit the form
  form.submit();
}