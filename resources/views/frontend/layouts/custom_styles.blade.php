<style>
    /* Pagination Active State */
    .page-item.active .page-link {
        z-index: 1;
        color: #fff !important;
        background-color: #d8373e !important;
        border-color: #d8373e !important;
    }

    /* Skeleton Loading Animation */
    .skeleton {
        background: linear-gradient(90deg, #eee, #ddd, #eee);
        background-size: 200% 100%;
        animation: skeleton-loading 1.2s infinite;
        border-radius: 6px;
    }

    @keyframes skeleton-loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .skeleton-img {
        width: 100%;
        height: 200px;
        margin-bottom: 10px;
    }

    .skeleton-text {
        height: 15px;
        width: 80%;
        margin-bottom: 8px;
    }

    .skeleton-text.small {
        width: 60%;
    }

    .skeleton-price {
        height: 20px;
        width: 40%;
    }
    
    /* Toastr Custom Depth (Ensure it shows over modals) */
    #toast-container {
        z-index: 999999 !important;
    }
</style>