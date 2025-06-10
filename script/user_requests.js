function filterRequests() {
    const filterValue = document.getElementById("statusFilter").value;
    const requestCards = document.querySelectorAll(".request_card");  // Используем класс
  
    requestCards.forEach(card => {
      const status = card.getAttribute("data-status"); // Используем dataset 
      card.style.display = (filterValue === "all" || filterValue === status) ? "block" : "none";  // Блок, т.к. card
    });
  }