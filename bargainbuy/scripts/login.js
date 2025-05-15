function showQuery(event) {
  event.preventDefault(); // Prevent form from submitting
  const email = document.forms["loginForm"]["username"].value;
  const password = document.forms["loginForm"]["psw"].value;
  const query = `SELECT * FROM Users WHERE email = '${email}' AND password = '${password}'`;
  alert("Query used:\n" + query + "\n\nPassword entered:\n" + password);
}
