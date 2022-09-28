import React from "react";
import reactDom from "react-dom/client";
import { HashRouter, Link, Route, Routes } from "react-router-dom";
import Cart from "./Profile/Cart";
import ChangePassword from "./Profile/ChangePassword";
import Order from "./Profile/Order";

const MainRouter = () => {
    return (
        <>
            <HashRouter>
                <div className="card p-5">
                    <div className="card-body">
                        <Link className="btn btn-warning" to={"/"}>
                            Cart
                        </Link>
                        <Link className="btn btn-warning" to={"/order"}>
                            Order list
                        </Link>
                        <Link
                            className="btn btn-warning"
                            to={"/change-password"}
                        >
                            Cahnge Password
                        </Link>
                    </div>
                </div>

                <Routes>
                    <Route path="/" element={<Cart />} />
                    <Route path="/order" element={<Order />} />
                    <Route
                        path="/change-password"
                        element={<ChangePassword />}
                    />
                </Routes>
            </HashRouter>
        </>
    );
};

reactDom.createRoot(document.getElementById("root")).render(<MainRouter />);
