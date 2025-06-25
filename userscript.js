  function showSection(id) {
    // Hide all sections
    document.querySelectorAll('.dashboard-section').forEach(section => {
      section.classList.remove('active');
    });

    // Show the selected one
    const selectedSection = document.getElementById(id);
    if (selectedSection) {
      selectedSection.classList.add('active');
    }

    // Highlight the active tab
    document.querySelectorAll('.sidebar ul li').forEach(li => {
      li.classList.remove('active-tab');
    });

    const clickedLi = Array.from(document.querySelectorAll('.sidebar ul li'))
      .find(li => li.innerText.includes(id.replace(/^\w/, c => c.toUpperCase())));

    if (clickedLi) {
      clickedLi.classList.add('active-tab');
    }
  }




  