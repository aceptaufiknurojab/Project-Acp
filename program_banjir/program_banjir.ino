#include <ESP8266WiFi.h>;
#include <WiFiClient.h>;
#include <ThingSpeak.h>;
#include  <Wire.h>
#include  <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);
const char* ssid = "Andromax-M3Y-4F2D"; 
const char* password = "33025303"; 
#define triggerPin  D8
#define echoPin     D7

#define buzzerlevel 16

WiFiClient client;
 
unsigned long myChannelNumber =1110584; //Channel ID: 769898
const char *myWriteAPIKey = "GIU917G3R9PTAAL9"; //Write API Key 0F1KKZS2ZUPMCNAY

void setup() {
  Serial.begin (115200);

  pinMode(triggerPin, OUTPUT);
  pinMode(echoPin, INPUT);
  pinMode(buzzerlevel, OUTPUT);

  pinMode(2, OUTPUT);

Wire.begin(D2, D1); 
lcd.init(); 

lcd.backlight();

digitalWrite(buzzerlevel, HIGH);
  lcd.setCursor(0,0);
  lcd.print("   Monitoring   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print(" Penampung Air' ");
  delay(2000);
  lcd.clear();
delay(10);
WiFi.begin(ssid, password);
ThingSpeak.begin(client);
lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
  lcd.print("   Monitoring   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print(" Penampung Air' ");
  delay(2000);
  lcd.clear();
}
void loop() {
  
  long duration, jarak;
  digitalWrite(triggerPin, LOW);
  delayMicroseconds(2); 
  digitalWrite(triggerPin, HIGH);
  delayMicroseconds(10); 
  digitalWrite(triggerPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  jarak = (duration/2) / 29.1;


  if (jarak >= 32 ){

digitalWrite(buzzerlevel, HIGH);
lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
  lcd.print("  KONDISI  AIR  ");
  lcd.setCursor(0,1);
  lcd.print("----->NORMAL-----");
   delay(5000);
lcd.clear();
}
else if (jarak >= 29 && jarak <=31){

digitalWrite(buzzerlevel, LOW);

lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
  lcd.print("  KONDISI  AIR  ");
  lcd.setCursor(0,1);
  lcd.print("---->SIAGA 3----");
   delay(5000);
lcd.clear();
}
else if (jarak >= 26 && jarak <=28){

digitalWrite(buzzerlevel, LOW);

lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
   lcd.print("  KONDISI  AIR  ");
  lcd.setCursor(0,1);
 lcd.print("---->SIAGA 2----");
   delay(5000);
lcd.clear();

}
else if (jarak >= 23 && jarak <=25){

digitalWrite(buzzerlevel, LOW);

lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
   lcd.print("  KONDISI  AIR  ");
  lcd.setCursor(0,1);
 lcd.print("---->SIAGA 1----");
   delay(5000);
lcd.clear();

}
else if (jarak >= 19 && jarak <= 22){
digitalWrite(buzzerlevel, LOW);
lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
   lcd.print("  KONDISI  AIR  ");
  lcd.setCursor(0,1);
 lcd.print("---->A W A S----");
   delay(2000);
lcd.clear();
  Serial.print("jarak :");
  Serial.print(jarak);
  Serial.println(" cm");

}


  else {
    digitalWrite(buzzerlevel, HIGH);
    lcd.clear();
digitalWrite(2, LOW);
delay(1000);
digitalWrite(2, HIGH);
delay(1000);
  lcd.setCursor(0,0);
  lcd.print("Jarak Sensor(Cm)");
  lcd.setCursor(0,1);
  lcd.print("Dengan Air:");
  lcd.setCursor(12,1);
  lcd.print(jarak);
  Serial.print("jarak :");
  Serial.print(jarak);
  Serial.println(" cm");
   delay(1000);
  ThingSpeak.writeField(myChannelNumber, 1,jarak, myWriteAPIKey);
  }
  delay(1000);
}
