// 🌡️ Netlify Function: getTemperature.js

const fetch = require("node-fetch");

const API_ENDPOINT = "https://api2.arduino.cc/iot/v2/things/34b9162c-4d03-40f9-8c76-1727a2f80aba/properties";
const BEARER_TOKEN = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJodHRwczovL2FwaTIuYXJkdWluby5jYy9pb3QiLCJhenAiOiJ6azdMVWFIWE9GcFRtWTh0T1ZvYmdXOWZQVWRUUTg1YyIsImV4cCI6MTc0NzQ1NjMwMiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIiwiaHR0cDovL2FyZHVpbm8uY2MvY2xpZW50X2lkIjoiYmhjY2dhcmRlbiIsImh0dHA6Ly9hcmR1aW5vLmNjL2lkIjoiYjdmZDcyOTItOWRiYi00YWNlLTllNTktNzRmNGQ1N2NmZjFiIiwiaHR0cDovL2FyZHVpbm8uY2MvcmF0ZWxpbWl0IjoxMCwiaHR0cDovL2FyZHVpbm8uY2MvdXNlcm5hbWUiOiJhbmF0b2xhcmR1aW5vIiwiaWF0IjoxNzQ3NDU2MDAyLCJzdWIiOiJ6azdMVWFIWE9GcFRtWTh0T1ZvYmdXOWZQVWRUUTg1Y0BjbGllbnRzIn0.eEmWu-xPYk9NemmEeMNEOn2_mss2PJI15mhMtXn9YVo"; 







exports.handler = async function(event, context) {
  console.log("Temperature function invoked");
  try {
    const response = await fetch(API_ENDPOINT, {
      headers: {
        "Authorization": `Bearer ${BEARER_TOKEN}`,
        "Content-Type": "application/json"
      }
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    console.log("API response received:", data.length, "properties");

    // Find the sensor properties
    const temperatureObj = data.find(p => p.name === "dHT11tsensor");
    const humidityObj = data.find(p => p.name === "dHT11hsenso");
    const soilMoistureObj = data.find(p => p.name === "capaitiveSoilMoistureSensor");
    const waterValveStatus = data.find(p => p.name === "water_valve") || { last_value: false };

    if (!temperatureObj) {
      console.warn("Temperature sensor data not found in API response");
      return {
        statusCode: 404,
        headers: {
          "Content-Type": "application/json",
          "Access-Control-Allow-Origin": "*"
        },
        body: JSON.stringify({
          error: "Temperature sensor data not found",
          timestamp: new Date().toISOString()
        })
      };
    }

    console.log("Temperature value:", temperatureObj.last_value);

    // Return successful response with all available sensor data
    return {
      statusCode: 200,
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Origin": "*"
      },
      body: JSON.stringify({
        temperature: temperatureObj.last_value,
        humidity: humidityObj ? humidityObj.last_value : null,
        soilMoisture: soilMoistureObj ? soilMoistureObj.last_value : null,
        waterValve: waterValveStatus.last_value,
        timestamp: new Date().toISOString(),
        location: "Everett, MA",
        device: "Arduino UNO R4 WiFi"
      })
    };
  } catch (err) {
    console.error("Temperature function error:", err);
    return {
      statusCode: 500,
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Origin": "*"
      },
      body: JSON.stringify({
        error: err.message,
        timestamp: new Date().toISOString()
      })
    };
  }
};