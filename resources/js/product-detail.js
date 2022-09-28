import axios from "axios";
import React, { useEffect, useState } from "react";
import reactDom from "react-dom/client";
import Loader from "./Component/Loader";
import Rating from "react-star-ratings";

const App = () => {
    const [loader, setLoader] = useState(true);
    const [product, setProduct] = useState({});
    const [review, setReview] = useState([]);
    const [cartLoader, setCartLoader] = useState(false);

    //for review
    const [rating, setRating] = useState(0);
    const [rev, setRev] = useState("");

    useEffect(() => {
        axios.get("/api/product-detail/" + product_slug).then((d) => {
            setProduct(d.data);
            setReview(d.data.review);
            setLoader(false);
        });
    }, []);

    const addToCart = () => {
        axios
            .get(
                `/api/add-to-cart?user_id=${authUser.id}&product_slug=${product_slug}`
            )
            .then((d) => {
                if (d.data.message === "added_to_cart") {
                    updateCart(d.data.cart_count);
                    showToast("Added To Cart");
                } else {
                    showToast("Wrong Something");
                }
            });
    };

    //change rating
    const changeRating = (newRateNo) => {
        setRating(newRateNo);
    };
    //submit review
    const submitReview = () => {
        var frmData = new FormData();
        frmData.append("rating", rating);
        frmData.append("review", rev);
        frmData.append("product_id", product.id);

        axios.post("/api/make-review", frmData).then(({ data }) => {
            setReview([...review, data]);
            showToast("Thank You. Review Success");
            setRating(0);
            setRev("");
        });
    };
    return (
        <>
            {loader && <Loader />}
            {!loader && (
                <div className="row">
                    <div className="col-12 mb-3">
                        <h3>{product.name}</h3>
                        <div>
                            <small className="text-muted">Brand:</small>
                            <small>{product.brand.name}</small>|
                            <small className="text-muted">Category:</small>
                            <small className="badge badge-dark">
                                {product.category.mm_name}
                            </small>
                        </div>
                    </div>
                    <div className="col-12 col-sm-12 col-md-4 col-lg-4">
                        <img className="w-100" src={product.image_url} alt="" />
                    </div>
                    <div className="col-12 col-sm-12 col-md-8 col-lg-8">
                        <div className="mt-5">
                            <p>
                                <small className="text-muted">
                                    <strike>{product.discount_price}ks</strike>
                                </small>
                                <span className="text-danger fs-1 d-inline">
                                    {product.sell_price}ks
                                </span>
                                <br />
                                <span className="btn btn-sm btn-outline-success text-success mt-3">
                                    InStock :{product.total_quantity}
                                </span>

                                {authUser !== null && (
                                    <button
                                        disabled={cartLoader}
                                        className="btn btn-sm btn-danger mt-3"
                                        onClick={() => addToCart()}
                                    >
                                        {cartLoader && (
                                            <div
                                                className="spinner-border text-dark "
                                                style={{
                                                    width: "23px",
                                                    height: "23px",
                                                }}
                                                role="status"
                                            >
                                                <span className="sr-only">
                                                    Loading...
                                                </span>
                                            </div>
                                        )}
                                        <i className="fas fa-shopping-cart" />
                                        Add To Cart
                                    </button>
                                )}
                                {authUser === null && (
                                    <a
                                        href="/login"
                                        className="text text-danger"
                                    >
                                        Please Login To Mange Cart
                                    </a>
                                )}
                            </p>
                            <p
                                className="mt-5"
                                dangerouslySetInnerHTML={{
                                    __html: product.description,
                                }}
                            ></p>
                            <small className="text-muted">
                                Available Color:
                            </small>
                            {product.color.map((c) => (
                                <span className="badge badge-danger" key={c.id}>
                                    {c.name}
                                </span>
                            ))}
                        </div>
                    </div>
                    <hr />
                    <div className="col-12" style={{ marginTop: 100 }}>
                        {/* loop review */}
                        {review.map((r) => (
                            <div className="review" key={r.id}>
                                <div className="card p-3">
                                    <div className="row">
                                        <div className="col-md-2">
                                            <div className="d-flex justify-content-between">
                                                <img
                                                    className="w-100 rounded-circle"
                                                    src={r.user.image_url}
                                                />
                                            </div>
                                        </div>
                                        <div className="col-md-10">
                                            <div className="rating">
                                                <Rating
                                                    rating={r.rating}
                                                    starRatedColor="red"
                                                    numberOfStars={5}
                                                    name="rating"
                                                    starDimension="15px"
                                                />
                                            </div>
                                            <div className="name">
                                                <b>{r.user.name}</b>
                                            </div>
                                            <div className="mt-3">
                                                <small>{r.review}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}

                        <div className="add-review mt-5">
                            <h4>Make Review</h4>
                            <div className="">
                                <Rating
                                    rating={rating}
                                    starRatedColor="red"
                                    changeRating={changeRating}
                                    numberOfStars={5}
                                    name="rating"
                                />
                            </div>
                            <div>
                                <textarea
                                    className="form-control"
                                    rows={5}
                                    placeholder="enter review"
                                    value={rev}
                                    onChange={(e) => setRev(e.target.value)}
                                />
                                <button
                                    onClick={() => submitReview()}
                                    className="btn btn-dark float-right mt-3"
                                >
                                    Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            )}
        </>
    );
};

reactDom.createRoot(document.getElementById("root")).render(<App />);
