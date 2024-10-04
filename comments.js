const express = require('express');
const axios = require('axios');
const path = require('path');
const app = express();
const port = 5000;

app.use(express.static(path.join(__dirname, 'public')));

app.get('/', async (req, res) => {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/comments');
        const data = response.data;

        let tableHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Comments (Node.js)</title>
            <link rel="stylesheet" href="/stylee.css">
        </head>
        <body>
            <h1>Data Comments dari JSON Placeholder API (Node.js)</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>`;

        data.forEach(post => {
            tableHTML += `
            <tr>
                <td>${post.id}</td>
                <td>${post.name}</td>
                <td>${post.email}</td>
                <td>${post.body}</td>
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
