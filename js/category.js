function redirectToPage() {
    var selectElement = document.getElementById("categorySelect");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var destinationUrl = selectedOption.value;
    
    // Redirect to the selected URL
    if (destinationUrl) {
      window.location.href = destinationUrl;
    }
  }

