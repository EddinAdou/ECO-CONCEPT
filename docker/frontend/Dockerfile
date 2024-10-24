FROM node:latest

# Set the working directory.
WORKDIR /var/www/frontend

# Copy the package.json and package-lock.json files.
COPY ../../frontend/package.json .

# Install the dependencies.
RUN npm install

# Copy the rest of your application code.
COPY ../../frontend /var/www/frontend

# Expose the port the app runs on.
EXPOSE ${NGINX_FRONT_PORT}

# Build the React application.
RUN npm run build

# Command to run the app.
CMD ["npm", "start"]