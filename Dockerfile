# Change Earth to Mars - JB 02/27/2019
# Added "Construction In Progress!" code to the "welcome_frontpage.blade.php" file - JB 03/01/2019
# Added VRStoryGram logo to img file - JB 03/07/2019 

FROM mattrayner/lamp:latest-1604-php7

SHELL ["/bin/bash", "-c"]

COPY sshd_config /tmp/sshd_config.in
COPY php.ini /etc/php/7.4/apache2/php.ini
COPY site /var/www/html/

#ADD https://github.com/hnstone/Credentials/blob/master/db_connection.php /var/www/html/site/scripts

RUN echo "installing" \
    && apt update \
    && apt -y install vim apt-utils wget openssh-server libpng-dev mysql-client dialog \
    && cat /tmp/sshd_config.in > /etc/ssh/sshd_config \
    && echo "/usr/sbin/service ssh start" >> /run.sh \
    && echo "root:Docker!" | chpasswd \
    && chown -R www-data:staff /var/www 

ENV PHP_UPLOAD_MAX_FILESIZE 2048M
ENV PHP_POST_MAX_SIZE 2048M

EXPOSE 80 2222
