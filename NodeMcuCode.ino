
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>


#include <NewPing.h>

const char* ssid = "Jio 919 4g";     
const char* password = "Rambo@4g"; 
const char* serverName = "http://192.168.29.89/ultrasonicsensor/post-esp-data.php"; 

String apiKeyValue = "tPmAT5Ab3j7F9";
String sensorLocation = "Slot_1";
#define TRIGGER_PIN D1
#define ECHO_PIN D2
#define MAX_DISTANCE 200
NewPing sonar(TRIGGER_PIN, ECHO_PIN, MAX_DISTANCE);
String status = "update";

void setup() {
  Serial.begin(9600);
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  unsigned int distance = sonar.ping_cm();
  if (distance < 50)
    status = "occupied";
  else
    status = "available";
  
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    WiFiClient client; 

    http.begin(client, serverName); 

   
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

   
    String httpRequestData = "api_key=" + apiKeyValue + "&location=" + sensorLocation + "&status=" + status;

    
    int httpResponseCode = http.POST(httpRequestData);

    if (httpResponseCode > 0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    } else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }

  
    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }
  
  delay(10000);
}
