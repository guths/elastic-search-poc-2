### POC para indexação e pesquisa de dados no Elasticsearch

### Instalação Elasticsearch

É necessário ter o Java instalado na máquina

``` 
curl -fsSL https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
```

Adicionando elastic nos repositórios
``` 
echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-7.x.list
```
Atualizando listas de pacotes
``` 
sudo apt update
```
Instalando o Elasticsearch
``` 
sudo apt install elasticsearch

``` 
É necessário descomentar a linha #network.host: localhost

```
sudo vim /etc/elasticsearch/elasticsearch.yml
```
Iniciando serviço
``` 
sudo systemctl start elasticsearch
```

Para testar se o Elasticsearch foi instalado com sucesso execute o comando:
```
curl -X GET 'http://localhost:9200'
```
Você deve receber uma mensagem como essa: 

```
Output
{
  "name" : "elasticsearch-ubuntu20-04",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "qqhFHPigQ9e2lk-a7AvLNQ",
  "version" : {
    "number" : "7.6.2",
    "build_flavor" : "default",
    "build_type" : "deb",
    "build_hash" : "ef48eb35cf30adf4db14086e8aabd07ef6fb113f",
    "build_date" : "2020-03-26T06:34:37.794943Z",
    "build_snapshot" : false,
    "lucene_version" : "8.4.0",
    "minimum_wire_compatibility_version" : "6.8.0",
    "minimum_index_compatibility_version" : "6.0.0-beta1"
  },
  "tagline" : "You Know, for Search"
}
```

Agora é necessário rodar o seed de logs com o seguinte comando 
```
php artisan db:seed --class=LogsTableSeeder
```

Com os logs cadastrados, é rodar os testes contidos no arquivo ElasticSearchTest.php

### POC para implementação e personalização de logs no Google Cloud 

Foi instalado o pacote google/cloud, utilizei o pacote que abrange
todos os serviços pois estava com problema para instalar 
apenas o Google Cloud Log 






