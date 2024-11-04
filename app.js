// app.js
const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const cors = require('cors');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 8000;

// Middleware
app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(express.static('public')); // Serve static files from public directory

// MongoDB connection
mongoose.connect(process.env.MONGODB_URI, {
    useNewUrlParser: true,
    useUnifiedTopology: true
}).then(() => {
    console.log('MongoDB connected');
}).catch(err => {
    console.error('MongoDB connection error:', err);
});

// Booking Schema
const bookingSchema = new mongoose.Schema({
    tour: String,
    name: String,
    email: String,
    date: Date,
    days: Number,
    message: String,
});

const Booking = mongoose.model('Booking', bookingSchema);

// Route for handling booking submission
app.post('/submit-booking', async (req, res) => {
    try {
        const booking = new Booking(req.body);
        await booking.save();
        res.status(201).json({ message: 'Booking confirmed!', booking });
    } catch (error) {
        console.error('Error saving booking:', error);
        res.status(500).json({ message: 'Error confirming booking' });
    }
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
