import axios from "axios";
import React, { useState } from "react";

const ChangePassword = () => {
    const [newPassword, setNewPassword] = useState("");
    const [currentPassword, setCurrentPassword] = useState("");
    const changePassword = () => {
        axios
            .post("/api/change-password", { newPassword, currentPassword })
            .then((d) => {
                const data = d.data;
                if (data === "you_already") {
                    showToast("old and new password the smme");
                } else if (data === "wrong_password") {
                    showToast("Invalid Current Password");
                } else {
                    showToast("Password Change Successfully.");
                }
            });
    };
    return (
        <>
            <div className="card p-5">
                <div className="card-body">
                    <h3>change Password</h3>
                    <div className="form-group">
                        <label htmlFor="">Enter Current Password</label>
                        <input
                            type="password"
                            onChange={(e) => setCurrentPassword(e.target.value)}
                            className="form-control"
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="">Enter New Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setNewPassword(e.target.value)}
                        />
                    </div>
                    <button
                        onClick={() => changePassword()}
                        className="btn btn-primary"
                    >
                        Change
                    </button>
                </div>
            </div>
        </>
    );
};

export default ChangePassword;

//password  Hash::check()
/**
 *   myanmar=10usd      visitor =  myan      900    
 *
 *   country (us canada)
 *   1000
 *   cpm  0.5
 *   rpm
 */
