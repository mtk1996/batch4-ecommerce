import React from "react";

const Loader = () => {
    return (
        <div className="p-5 d-flex justify-content-center align-items-center">
            <div className="spinner-border text-dark " role="status">
                <span className="sr-only">Loading...</span>
            </div>
        </div>
    );
};

export default Loader;
