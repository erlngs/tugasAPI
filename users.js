const express = require('express');
const axios = require('axios');
const path = require('path');
const app = express();
const port = 5500;

app.use(express.static(path.join(__dirname, 'public')));

app.get('/', async (req, res) => {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/users');
        const data = response.data;

        let tableHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Users (Node.js)</title>
            <link rel="stylesheet" href="/stylee.css">
        </head>
        <body>
            <h1>Data Users dari JSON Placeholder API (Node.js)</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th>Company</th>
                    </tr>
                </thead>
                <tbody>`;

        data.forEach(user => {
            tableHTML += `
            <tr>
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.address.street}, ${user.address.suite}, ${user.address.city}, ${user.address.zipcode}</td>
                <td>${user.phone}</td>
                <td>${user.website}</td>
                <td>${user.company.name}</td>
            </tr>`;
        });

        tableHTML += `
                </tbody>
            </table>
        </body>
        </html>`;
        
        res.send(tableHTML);
    } catch (error) {
        res.status(500).send('Error fetching data');
    }
});

app.listen(port, () => {
    console.log(`Server berjalan di http://localhost:${port}`);
});
