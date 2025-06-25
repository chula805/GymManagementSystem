const menuIcon = document.querySelector(".menu__icon");
const navLinks = document.querySelector(".nav__links");
const openIcon = document.querySelector(".open-icon");
const closeIcon = document.querySelector(".close-icon");

menuIcon.addEventListener("click", () => {
  navLinks.classList.toggle("show");

  if (navLinks.classList.contains("show")) {
    openIcon.style.display = "none";
    closeIcon.style.display = "inline";
  } else {
    openIcon.style.display = "inline";
    closeIcon.style.display = "none";
  }
});

const grid = document.querySelector(".explore__grid");
const cards = document.querySelectorAll(".explore__card");
const prevBtn = document.querySelector(".explore__nav span:first-child");
const nextBtn = document.querySelector(".explore__nav span:last-child");

let currentIndex = 0;
const cardsToShow = 4;
const totalCards = cards.length;

const cardWidth = cards[0].offsetWidth + 32; // width + 2rem gap
const maxIndex = totalCards - cardsToShow;

function slideTo(index) {
  grid.style.transform = `translateX(-${index * cardWidth}px)`;
}

nextBtn.addEventListener("click", () => {
  if (currentIndex < maxIndex) {
    currentIndex++;
  } else {
    currentIndex = 0;
  }
  slideTo(currentIndex);
});

prevBtn.addEventListener("click", () => {
  if (currentIndex > 0) {
    currentIndex--;
  } else {
    currentIndex = maxIndex;
  }
  slideTo(currentIndex);
});

// Auto Slide
setInterval(() => {
  currentIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
  slideTo(currentIndex);
}, 4000); // every 4 seconds

const playBtn = document.getElementById("playButton");
const videoModal = document.getElementById("videoModal");
const closeBtn = document.getElementById("closeModal");

playBtn.addEventListener("click", () => {
  videoModal.style.display = "flex";
});

closeBtn.addEventListener("click", () => {
  videoModal.style.display = "none";
  videoModal.querySelector("iframe").src += "";
});

videoModal.addEventListener("click", (e) => {
  if (e.target === videoModal) {
    videoModal.style.display = "none";
    videoModal.querySelector("iframe").src += "";
  }
});

  

  const tabs = document.querySelectorAll(".auth__tab");
  const forms = document.querySelectorAll(".auth__form");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      // Remove active from all tabs
      tabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");

      // Hide all forms
      forms.forEach(f => f.classList.remove("active"));

      // Show target form
      const target = document.getElementById(tab.dataset.target);
      if (target) target.classList.add("active");
    });
  });



  document.addEventListener("DOMContentLoaded", function () {
    const bmiIcon = document.getElementById("bmi-icon");
    const bmiPopup = document.getElementById("bmi-popup");
    const closeBmi = document.getElementById("closeBmi");
    const bmiForm = document.getElementById("bmiForm");
    const bmiResult = document.getElementById("bmiResult");

    if (bmiIcon && bmiPopup && closeBmi) {
      bmiIcon.addEventListener("click", () => {
        bmiPopup.style.display = "block";
      });

      closeBmi.addEventListener("click", () => {
        bmiPopup.style.display = "none";
        bmiForm.reset();
        bmiResult.innerHTML = "";
      });

      bmiForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const height = parseFloat(document.getElementById("height").value) / 100;
        const weight = parseFloat(document.getElementById("weight").value);
        const bmi = weight / (height * height);
        let category = "";

        if (bmi < 18.5) category = "Underweight";
        else if (bmi < 24.9) category = "Normal";
        else if (bmi < 29.9) category = "Overweight";
        else category = "Obese";

        bmiResult.innerHTML = `<p>Your BMI: <strong>${bmi.toFixed(2)}</strong> (${category})</p>`;
      });
    }
  });



function openJoinModal(programId, programTitle) {
  document.getElementById('joinProgramModal').style.display = 'block';
  document.getElementById('programIdInput').value = programId;
  document.getElementById('programDisplayName').textContent = programTitle;
}

function closeJoinModal() {
  document.getElementById('joinProgramModal').style.display = 'none';
}


  // Optional: Close modal when clicking outside
  window.onclick = function (event) {
    const modal = document.getElementById("joinProgramModal");
    if (event.target === modal) modal.style.display = "none";
  }




function openMembershipModal(planName) {
    document.getElementById('membershipModal').style.display = 'block';
    document.getElementById('selectedPlan').textContent = planName;
    document.getElementById('planInput').value = planName;

    let details = {
      "Basic": "LKR 2,500/mo. Includes gym equipment access. No trainer or classes. Pay monthly or 6 months in advance.",
      "Standard": "LKR 4,500/mo. Includes gym, trainer (4 sessions), and classes. Payment options: monthly or quarterly.",
      "Premium": "LKR 7,500/mo. Unlimited access, daily trainer, nutrition plan. Payment monthly or annually with 10% discount."
    };

    document.getElementById('planDetails').textContent = details[planName] || '';
  }

  function closeMembershipModal() {
    document.getElementById('membershipModal').style.display = 'none';
  }



  var swiper = new Swiper('.equipmentSwiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    breakpoints: {
      576: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      }
    }
  });
