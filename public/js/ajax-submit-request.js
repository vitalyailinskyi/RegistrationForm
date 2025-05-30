document.getElementById('registration_form').addEventListener('submit', async function (e) {
   e.preventDefault(); // Stop form from reloading page

   const formData = new FormData(this);
   const data = Object.fromEntries(formData.entries());

   const response = await fetch('/register', {
      method: 'POST',
      headers: {
         'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
   });

   const result = await response.json();

   const resultDivPopup = document.querySelector('.popup');
   if (resultDivPopup) resultDivPopup.style.display = 'block';
   if(response.ok){
      resultDivPopup.classList.add('success');
      resultDivPopup.innerHTML = `${result.message}`;
      this.reset();
   } else {
      resultDivPopup.classList.add('error');
      resultDivPopup.innerHTML = `${result.error}`;
   }

   setTimeout(()=> {
      if (resultDivPopup) resultDivPopup.style.display = 'none';
      resultDivPopup.classList.remove('success', 'error'); // clear styles
   },3000);
});