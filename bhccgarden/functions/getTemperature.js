const fetch = require('node-fetch');

const CLIENT_ID = "eE1fxEycwg8e693BlhzXhTzudtfRo5zS";
const CLIENT_SECRET = "MUeehKBcXYQGbi1t197yQJUWNpwSoNl1IdP5wgtdMcEs2TjdIn2AnKh8K05IiKGA";
const THING_ID = "a49ac818-fb0f-4320-9194-4d72d0a13765";
const PROPERTY_ID = "9ee5a505-d461-480c-983b-a02449fe6ea8";

exports.handler = async function(event, context) {
  try {
    // Step 1: Get token
    const authRes = await fetch("https://api2.arduino.cc/iot/v1/clients/token", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({
        grant_type: "client_credentials",
        client_id: CLIENT_ID,
        client_secret: CLIENT_SECRET,
        audience: "https://api2.arduino.cc/iot"
      })
    });
    const authData = await authRes.json();
    const token = authData.access_token;

    // Step 2: Get variable
    const dataRes = await fetch(`https://api2.arduino.cc/iot/v2/things/${THING_ID}/properties/${PROPERTY_ID}/lastvalue`, {
      headers: {
        "Authorization": `Bearer ${token}`,
        "Content-Type": "application/json"
      }
    });

    const data = await dataRes.json();
    return {
      statusCode: 200,
      body: JSON.stringify({ temp: data.value })
    };

  } catch (error) {
    return {
      statusCode: 500,
      body: JSON.stringify({ error: error.message })
    };
  }
};
