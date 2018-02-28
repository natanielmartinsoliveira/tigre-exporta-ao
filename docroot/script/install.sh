## Instalação

### Linux

drush si tigre -y
drush config-set "system.site" uuid "65e853d3-e79d-4b6c-9eb0-a308e5beb4b8" -y
drush config-set "language.entity.en" "uuid" "65e853d3-e79d-4b6c-9eb0-a308e5beb4b8" -y
drush cim -y --quiet
drush cr
