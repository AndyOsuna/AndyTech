searchUI = document.querySelector('#search');

searchUI.addEventListener('keyup', e => {
  console.log(searchUI.value);

  fetch('search.php?search=' + searchUI.value, {
    method: 'GET'
  })
    .then(data => {
      console.log(data)
      document.write(JSON.stringify(data))
    })

})