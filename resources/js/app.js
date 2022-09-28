import React from "react";
import reactDom from "react-dom/client";

const App = () => <h1>Hello From React Component</h1>;

reactDom.createRoot(document.getElementById("root")).render(<App />);
