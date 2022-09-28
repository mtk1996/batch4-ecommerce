import axios from "axios";
import React, { useEffect, useState } from "react";
import reactDom from "react-dom/client";
import Loader from "./Component/Loader";

const App = () => {
    const [category, setCategory] = useState([]);
    const [product, setProduct] = useState([{ product: [] }]);
    const [fProduct, setFProduct] = useState([]);
    const [loader, setLoader] = useState(true);
    useEffect(() => {
        axios.get("/api/home").then(({ data }) => {
            setCategory(data.category);
            setProduct(data.product);
            setFProduct(data.feature_product);
            setLoader(false);
        });
    }, []);

    return (
        <>
            {loader && <Loader />}

            {!loader && (
                <>
                    <div className="w-80 mt-5">
                        <div className="row mt-2">
                            {/* loop category */}
                            {category.map((c) => (
                                <div
                                    key={c.id}
                                    className="col-12 col-sm-12 col-md-3 col-lg-3 border"
                                >
                                    <a href="" className="text-dark">
                                        <div className="d-flex justify-content-around align-items-center p-3">
                                            <img
                                                src="/web_assets/images/category.jpeg"
                                                width={100}
                                                alt=""
                                            />
                                            <div className="text-center">
                                                <p className="fs-2">
                                                    {lang === "mm"
                                                        ? c.mm_name
                                                        : c.en_name}
                                                </p>
                                                <small className="">
                                                    {c.product_count} items
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div className="w-80 mt-5">
                        <div className="row">
                            <div className="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                {fProduct.map((d) => (
                                    <a href="" key={d.id}>
                                        <div className="border bg-warning p-5 text-center rounded">
                                            <img
                                                src={d.image_url}
                                                className="w-80 margin-auto  rounded"
                                                alt=""
                                            />
                                            <div className="mt-5">
                                                <h4 className="text-center mt-4 text-white">
                                                    {d.name}
                                                </h4>
                                                <span className="text badge badge-white">
                                                    {d.sell_price}ks
                                                </span>
                                                <span className="text badge badge-danger">
                                                    <strike>
                                                        {d.discount_price}ks
                                                    </strike>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                ))}
                            </div>

                            <div className="col-12 col-sm-12 col-md-9 col-lg-9">
                                {product.map((p) => (
                                    <div className="row" key={p.id}>
                                        {/* products */}
                                        <div className="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                                            <div className="row">
                                                <div className="col-12">
                                                    <div className="d-flex justify-content-between align-items-center">
                                                        <b className="fs-1">
                                                            {p.name}
                                                        </b>
                                                        <a
                                                            href=""
                                                            className="btn btn-warning"
                                                        >
                                                            View All
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="row">
                                                {/* loop product */}
                                                {p.product.map((d) => {
                                                    return (
                                                        <div
                                                            key={d.id}
                                                            className="col-12 col-md-4 text-center mt-2"
                                                        >
                                                            <a
                                                                href={`/product/${d.slug}`}
                                                            >
                                                                <div className="card p-2">
                                                                    <img
                                                                        src={
                                                                            d.image_url
                                                                        }
                                                                        alt=""
                                                                        className="w-100"
                                                                    />
                                                                    <b>
                                                                        {d.name}
                                                                    </b>
                                                                    <div>
                                                                        <small className=" badge badge-danger">
                                                                            {" "}
                                                                            <strike>
                                                                                {
                                                                                    d.discount_price
                                                                                }{" "}
                                                                                ks
                                                                            </strike>{" "}
                                                                        </small>
                                                                        <small className="badge bg-primary">
                                                                            {
                                                                                d.sell_price
                                                                            }
                                                                            ks
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    );
                                                })}
                                            </div>
                                        </div>
                                    </div>
                                ))}

                                {/* end loop */}
                            </div>
                        </div>
                    </div>
                </>
            )}
        </>
    );
};

reactDom.createRoot(document.getElementById("root")).render(<App />);
