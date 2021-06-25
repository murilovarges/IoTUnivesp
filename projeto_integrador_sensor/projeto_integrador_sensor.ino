// Projeto integrador UNIVESP
// Monitoramento de temperatura
// Utilizando comunicação GPRS
#include <OneWire.h>
#include <DallasTemperature.h>
#include <SoftwareSerial.h>
#include <String.h>

// Porta do sinal do sensor de temperaturaDS18B20
#define ONE_WIRE_BUS 5
// Postas do módulo SIM800L
#define TX_PORT 2
#define RX_PORT 3
 
// Define uma instancia do oneWire para comunicacao com o sensor
OneWire oneWire(ONE_WIRE_BUS);
 
// Armazena temperaturas minima e maxima
float tempMin = 999;
float tempMax = 0;

long randNumber;
String url = "sentora.bri.ifsp.edu.br";
String api_url = "GET http://sentora.bri.ifsp.edu.br/~bi112616/iotunivesp/api?api_key=KEY_WRITE_123&field=";

SoftwareSerial gprsSerial(TX_PORT, RX_PORT);
DallasTemperature sensors(&oneWire);
DeviceAddress sensor1;

// Configurações iniciais do sistema
void setup()
{
  gprsSerial.begin(9600); // the GPRS baud rate   
  Serial.begin(9600);    // the Serial baud rate 


  sensors.begin();
  // Localiza e mostra enderecos dos sensores
  Serial.println("Localizando sensores DS18B20...");
  Serial.print("Foram encontrados ");
  Serial.print(sensors.getDeviceCount(), DEC);
  Serial.println(" sensores.");
  if (!sensors.getAddress(sensor1, 0)) 
     Serial.println("Sensores nao encontrados !"); 
  // Mostra o endereco do sensor encontrado no barramento
  Serial.print("Endereco sensor: ");
  mostra_endereco_sensor(sensor1);
  Serial.println();
  delay(1000);
  randomSeed(analogRead(0));
}

void mostra_endereco_sensor(DeviceAddress deviceAddress)
{
  for (uint8_t i = 0; i < 8; i++)
  {
    // Adiciona zeros se necessário
    if (deviceAddress[i] < 16) Serial.print("0");
    Serial.print(deviceAddress[i], HEX);
  }
}
 

// Laço principal de leitura de temperatura e envio 
void loop()
{    
    if (gprsSerial.available())
      Serial.write(gprsSerial.read());
    float tempC = ReadTemperature();
    SendData(tempC);  
}

float ReadTemperature()
{
  // Le a informacao do sensor
  sensors.requestTemperatures();
  float tempC = sensors.getTempC(sensor1);
  // Atualiza temperaturas minima e maxima
  if (tempC < tempMin)
  {
    tempMin = tempC;
  }
  if (tempC > tempMax)
  {
    tempMax = tempC;
  }
  // Mostra dados no serial monitor
  Serial.print("Temp C: ");
  Serial.print(tempC);
  Serial.print(" Min : ");
  Serial.print(tempMin);
  Serial.print(" Max : ");
  Serial.println(tempMax);
  return tempC;
}


void SendData(float tempC)
{
    gprsSerial.println("AT");
    delay(500);
    ShowSerialData();    
   
    gprsSerial.println("AT+CPIN?");
    delay(500);
    ShowSerialData();
   
    gprsSerial.println("AT+CREG?");
    delay(500);
    ShowSerialData();    
   
    gprsSerial.println("AT+CGATT?");
    delay(500);
    ShowSerialData();    
   
    gprsSerial.println("AT+CIPSHUT");
    delay(500);
    ShowSerialData();    
   
    gprsSerial.println("AT+CIPSTATUS");
    delay(2000);
    ShowSerialData();
   
    gprsSerial.println("AT+CIPMUX=0");
    delay(2000);   
    ShowSerialData();
   
    gprsSerial.println("AT+CSTT=\"tim.br\"");//start task and setting the APN,
    delay(1000);   
    ShowSerialData();
   
    gprsSerial.println("AT+CIICR");//bring up wireless connection
    delay(1000);   
    ShowSerialData();
   
    gprsSerial.println("AT+CIFSR");//get local IP adress
    delay(1000);   
    ShowSerialData();
   
    gprsSerial.println("AT+CIPSPRT=0");
    delay(2000);   
    ShowSerialData();
    

    gprsSerial.println("AT+CIPSTART=\"TCP\",\"sentora.bri.ifsp.edu.br\",\"80\"");//start up the connection
    delay(2000);
   
    ShowSerialData();
   
    gprsSerial.println("AT+CIPSEND");//begin send data to remote server
    delay(2000);
    ShowSerialData();
    //randNumber = random(15, 36);
    //Serial.println(randNumber);    
    String str="GET http://sentora.bri.ifsp.edu.br/~bi112616/iotunivesp/api?api_key=KEY_WRITE_123&field="+String(tempC); 
    Serial.println(str);
    gprsSerial.println(str);//begin send data to remote server
    
    delay(2000);
    ShowSerialData();
   
    gprsSerial.println((char)26);//sending
    delay(2000);//waitting for reply, important! the time is base on the condition of internet 
    //gprsSerial.println();   
    ShowSerialData();
   
    gprsSerial.println("AT+CIPSHUT");//close the connection
    delay(100);
    ShowSerialData();  
}

void ShowSerialData()
{
  while(gprsSerial.available()!=0)
  Serial.write(gprsSerial.read());
  delay(1000);
}
