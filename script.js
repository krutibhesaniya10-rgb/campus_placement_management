
// Basic interactivity (you can extend later)
document.addEventListener("DOMContentLoaded", () => {
  console.log("About Us page loaded!");
});

function validateApplyForm() {
  let email = document.getElementById("email").value;
  let jobId = document.getElementById("job_id").value;

  let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address");
    return false;
  }

  if (isNaN(jobId)) {
    alert("Job ID must be a number");
    return false;
  }

  return true;
}


function filterTable() {
  let input = document.getElementById("searchInput").value.toUpperCase();
  let table = document.getElementById("statusTable");
  let tr = table.getElementsByTagName("tr");

  for (let i = 1; i < tr.length; i++) {
    let tdName = tr[i].getElementsByTagName("td")[0];
    let tdDept = tr[i].getElementsByTagName("td")[2];
    if (tdName || tdDept) {
      let txtValueName = tdName.textContent || tdName.innerText;
      let txtValueDept = tdDept.textContent || tdDept.innerText;
      if (txtValueName.toUpperCase().indexOf(input) > -1 || txtValueDept.toUpperCase().indexOf(input) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
/*============================
 Stats Section
================================*/
 document.addEventListener('DOMContentLoaded', () => {
      const counters = document.querySelectorAll('.support-counter');
      const speed = 200;

      counters.forEach(counter => {
        const updateCount = () => {
          const target = +counter.getAttribute('data-target');
          const count = +counter.innerText;

          const increment = target / speed;

          if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCount, 20);
          } else {
            counter.innerText = target + "+";
          }
        };

        updateCount();
      });
    });


function showProfile() {
      document.getElementById("login-link").classList.add("hidden");
      document.getElementById("profile-link").classList.remove("hidden");
    }

    // Test: auto show profile after 2 sec
    setTimeout(showProfile, 2000);

/*============================
 Hero Section 
================================*/
  const slogans = [
    "We connect students with the right opportunities, helping them build successful careers and bright futures.",
    "Empowering talent with the skills and confidence to achieve their dreams.",
    "Shaping the leaders of tomorrow through guidance and opportunity."
  ];

  let index = 0;
  const sloganElement = document.getElementById("slogan");

  function changeSlogan() {
    sloganElement.style.opacity = 0; // fade out
    setTimeout(() => {
      sloganElement.textContent = slogans[index];
      sloganElement.style.opacity = 1; // fade in
      index = (index + 1) % slogans.length;
    }, 1000); // wait for fade out
  }

  // Start rotation
  changeSlogan();
  setInterval(changeSlogan, 4000); // change every 4 sec

  /*======================
  log in
  =======================*/
  // Get elements
    const avatar = document.getElementById('avatar');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Toggle dropdown on avatar click
    avatar.addEventListener('click', () => {
        dropdownMenu.classList.toggle('show');
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', e => {
        if (!avatar.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

/*====================
contact us
====================*/
/* JS validation */
document.getElementById("contactForm").addEventListener("submit", function(e) {
  let name = document.getElementById("name").value.trim();
  let email = document.getElementById("email").value.trim();
  let message = document.getElementById("message").value.trim();
  let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

  if(name === "" || email === "" || message === "") {
    alert("All fields are required!");
    e.preventDefault();
  } else if(!email.match(emailPattern)) {
    alert("Please enter a valid email!");
    e.preventDefault();
  }
});

