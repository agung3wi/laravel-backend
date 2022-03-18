rsync -avz ./ ubuntu@108.136.208.99:/home/ubuntu/laravel-backend/ --exclude=.env --exclude=storage --exclude=.git --delete
