## Instalação

### Linux
Instalar profile tigre

\# drush si tigre -y

Setar system.site

\# drush config-set "system.site" uuid "65e853d3-e79d-4b6c-9eb0-a308e5beb4b8" -y

Setar uuid language default english

\# drush config-set "language.entity.en" "uuid" "65e853d3-e79d-4b6c-9eb0-a308e5beb4b8" -y

Os itens acima para ser setado é para que seja feita uma importacao correta

Rodar o config-import

\# drush cim -y



Finalmente limpar o cache
\# drush cr