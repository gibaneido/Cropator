## Cropator

Um experimento em Laravel para detectar rostos automagicamente.

### Exemplo de uso

```
GET /detect?url=https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQsGgi3pi3pu4dvOlbIP1qgVmCHrt6jhWQC2JjK-fRNB8-DsavN
```

### Estrutura

Classe ```app/models/Detector.php``` é uma interface simples para [php-facedetection](https://github.com/mauricesvay/php-facedetection). Em ```app/routes.php``` uma rota recebe o parâmetro da imagem hospedada e retorna a face detectada.

