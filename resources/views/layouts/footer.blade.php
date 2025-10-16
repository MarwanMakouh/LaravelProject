<style>
    /* Footer styling met zwarte achtergrond */
    .footer {
        background-color: #000000 !important;
        padding: 1.5rem 2rem;
        margin: 0;
        margin-top: 3rem;
        width: 100%;
        border-top: 1px solid #333333;
        box-sizing: border-box;
    }

    .footer-content {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 100%;
        text-align: center;
    }

    .footer-text {
        color: #ffffff !important;
        margin: 0;
        font-size: 0.95rem;
    }

    /* Light theme styles voor footer */
    body.light-theme .footer {
        background-color: #f0f0f0 !important;
        border-top: 1px solid #ddd;
    }

    body.light-theme .footer-text {
        color: #000000 !important;
    }

    /* Responsive aanpassingen */
    @media (max-width: 768px) {
        .footer {
            padding: 1rem;
        }

        .footer-text {
            font-size: 0.85rem;
        }
    }
</style>

<footer class="footer">
    <div class="footer-content">
        <p class="footer-text">&copy; {{ date('Y') }} GamePortal - gemaakt met Laravel</p>
    </div>
</footer>
