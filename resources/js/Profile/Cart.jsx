import axios from "axios";
import React, { useEffect, useState } from "react";
import Loader from "../Component/Loader";
const Cart = () => {
    const [loader, setLoader] = useState(true);
    const [cart, setCart] = useState([]);
    const [totalPrice, setTotalPrice] = useState(400);

    const [payment, setPayment] = useState("");
    const [phone, setPhone] = useState("");
    const [address, setAddress] = useState("");
    useEffect(() => {
        axios.get("/api/cart").then((d) => {
            const dbCart = d.data;
            setCart(dbCart);
            setLoader(false);
        });
    }, []);

    const TotalPrice = () => {
        var price = 0;
        if (!loader) {
            cart.map((item) => {
                price += item.total_quantity * item.product.sell_price;
            });
        }
        return <td>{price} ks</td>;
    };

    const addCart = (id) => {
        const newCarts = cart.map((d) => {
            if (d.id === id) {
                d.total_quantity += 1;
            }
            return d;
        });
        setCart(newCarts);
    };
    const saveCart = (id, totalQty) => {
        axios.post("/api/change-cart/" + id, { totalQty }).then((d) => {
            const data = d.data;
            if (data === "success") {
                showToast("Cart Quantity Updated");
            }
        });
    };
    const reduceCart = (id) => {};

    const makeOrder = () => {
        var frmData = new FormData();
        frmData.append("address", address);
        frmData.append("payment", payment);
        frmData.append("phone", phone);
        axios.post("/api/make-order", frmData).then((d) => {
            const data = d.data;
            if (data === "success") {
                setCart([]);
                setAddress("");
                setPhone("");
                setPayment("");
                showToast("Order Success,Please Wait For Delivery");
            }
        });
    };
    return (
        <>
            <div className="card p-5">
                <div className="card-body">
                    {loader && <Loader />}

                    {!loader && (
                        <>
                            <h2>Your Cart List</h2>
                            <table className="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Cart Qty</th>
                                        <th>Add/Reduce</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {cart.map((c) => (
                                        <tr key={c.id}>
                                            <td>
                                                <img
                                                    width={100}
                                                    src={c.product.image_url}
                                                    alt={c.product.name}
                                                />
                                            </td>

                                            <td>{c.product.name}</td>
                                            <td>{c.product.sell_price}ks</td>
                                            <td>{c.total_quantity}</td>
                                            <td>
                                                <button
                                                    onClick={() =>
                                                        reduceCart(c.id)
                                                    }
                                                    className="btn btn-sm btn-dark"
                                                >
                                                    -
                                                </button>
                                                <input
                                                    type="number"
                                                    value={c.total_quantity}
                                                    disabled
                                                />
                                                <button
                                                    className="btn btn-sm btn-dark"
                                                    onClick={() =>
                                                        addCart(c.id)
                                                    }
                                                >
                                                    +
                                                </button>
                                                <button
                                                    onClick={() =>
                                                        saveCart(
                                                            c.id,
                                                            c.total_quantity
                                                        )
                                                    }
                                                    className="btn btn-sm  btn-danger"
                                                >
                                                    Save
                                                </button>
                                            </td>
                                            <td>
                                                {c.total_quantity *
                                                    c.product.sell_price}
                                                ks
                                            </td>
                                        </tr>
                                    ))}

                                    <tr>
                                        <td colSpan={5}>Total Price</td>
                                        <TotalPrice />
                                    </tr>
                                </tbody>
                            </table>

                            <div className="card p-3">
                                <div className="form-group">
                                    <label htmlFor="">
                                        Enter Payment Address
                                    </label>
                                    <input
                                        value={payment}
                                        onChange={(e) =>
                                            setPayment(e.target.value)
                                        }
                                        type="text"
                                        className="form-control"
                                    />
                                </div>
                                <div className="form-group">
                                    <label htmlFor="">Enter Phone</label>
                                    <input
                                        value={phone}
                                        onChange={(e) =>
                                            setPhone(e.target.value)
                                        }
                                        type="number"
                                        className="form-control"
                                    />
                                </div>
                                <div className="form-group">
                                    <label htmlFor="">Enter Full Address</label>
                                    <textarea
                                        value={address}
                                        onChange={(e) =>
                                            setAddress(e.target.value)
                                        }
                                        className="form-control"
                                    ></textarea>
                                </div>
                            </div>
                            <button
                                onClick={() => makeOrder()}
                                className="btn btn-primary"
                            >
                                Order
                            </button>
                        </>
                    )}
                </div>
            </div>
        </>
    );
};

export default Cart;
