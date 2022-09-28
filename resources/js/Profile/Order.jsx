import axios from "axios";
import React, { useEffect, useState } from "react";
import Loader from "../Component/Loader";
const Order = () => {
    const [order, setOrder] = useState({});
    const [orderarr, setOrderarr] = useState([]);
    const [loader, setLoader] = useState(true);
    const [page, setPage] = useState(1); //2
    useEffect(() => {
        axios.get("/api/order").then(({ data }) => {
            setOrder(data);
            setOrderarr(data.data);
            setLoader(false);
        });
    }, []);

    const nextPage = () => {
        const newPage = page + 1; //2
        setPage(newPage);
        axios.get("/api/order?page=" + newPage).then(({ data }) => {
            setOrder(data);
            setOrderarr(data.data);
            setLoader(false);
        });
    };
    const prevPage = () => {
        const newPage = page - 1; //2
        setPage(newPage);
        axios.get("/api/order?page=" + newPage).then(({ data }) => {
            setOrder(data);
            setOrderarr(data.data);
            setLoader(false);
        });
    };

    const changePage = (link) => {
        axios.get(link).then(({ data }) => {
            setOrder(data);
            setOrderarr(data.data);
            setLoader(false);
        });
    };
    return (
        <>
            {loader && <Loader />}
            {!loader && (
                <div className="card p-5">
                    <div className="card-body">
                        <h3>Order List</h3>
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Total Quantity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {orderarr.map((d) => (
                                    <tr key={d.id}>
                                        <td>
                                            <img
                                                src={d.product.image_url}
                                                className="img-thumbnail"
                                                width={70}
                                            />
                                        </td>
                                        <td>{d.product.name}</td>
                                        <td>{d.total_quantity}</td>
                                        <td>
                                            {d.status === "success" && (
                                                <span className="badge badge-success">
                                                    {d.status}
                                                </span>
                                            )}

                                            {d.status === "pending" && (
                                                <span className="badge badge-warning">
                                                    {d.status}
                                                </span>
                                            )}
                                            {d.status === "reject" && (
                                                <span className="badge badge-danger">
                                                    {d.status}
                                                </span>
                                            )}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                        <div>
                            <button
                                className="btn btn-sm btn-primary"
                                onClick={() => prevPage()}
                                disabled={
                                    order.prev_page_url === null ? true : false
                                }
                            >
                                Prev
                            </button>

                            {order.links.map((d, i) => {
                                return (
                                    <button
                                        onClick={() => changePage(d.url)}
                                        key={i}
                                        className={`
                                    btn  btn-sm
                                    ${
                                        d.label.search("Prev") !== -1 ||
                                        d.label.search("Next") !== -1
                                            ? "d-none"
                                            : ""
                                    }
                                    ${
                                        d.active == true
                                            ? "btn-danger"
                                            : "btn-primary"
                                    }

                                `}
                                    >
                                        {d.label}
                                    </button>
                                );
                            })}

                            <button
                                className="btn btn-sm btn-primary "
                                disabled={
                                    order.next_page_url === null ? true : false
                                }
                                onClick={() => nextPage()}
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </>
    );
};

export default Order;
