# vrstorygram
startup for VRStoryGram

## Azure Container Service setup

Web App + MySQL : This creates an App Service plus a MySQL Database

## Running in Docker on Linux

```
docker run -d --env mysql_database=*MySQL_DB_Name* \
    --env mysql_host=*MySQL_host* \
    --env mysql_database=*MySQL_DBName* \
    --env mysql_userid=*MySQL_Username* \
    --env mysql_password=*MySQL_Password* \
    --env mysql_prefix=*Table_Prefix_* \
    -p 80:80 -p 2022:2222 tfournet/vrstorygram-docker
```

## Setting up CI/CD
GitHub - In repo settings, set up webhook push to DockerHub
DockerHub - In WebHooks settings, set up push to Azure App Service